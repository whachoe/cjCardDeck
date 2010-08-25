<?php
class Card
{
    const COLOR1 = 'red';
    const COLOR2 = 'black';
    
    public $suit;       // The suit of the card
    public $color;      // The color of the card
    public $name;       // Name of the card
    public $symbol;     // The number or symbol of the card
    public $ranking;    // The overal ranking of this card in its suit
    public $image;      // The image for this card
    public $backimage;  // The image of the backside of the card


    function __construct($suit='', $color='', $name='')
    {
        
    }

    public function getImgTag()
    {
        return '<img src="'.$this->image.'" class="cardimg" alt="'.$this->name.'" title="'.$this->name.'" />';
    }

    public function getBackImgTag()
    {
        return '<img src="'.$this->backimage.'" class="cardimg_back" alt="Card Back" title="Card Back" />';
    }
}


abstract class cardDeck
{
    public $deck = array(); // The array that holds Card-objects

    public function shuffle()
    {
        shuffle($this->deck);
    }

    public function drawCard()
    {
        $card = array_shift($this->deck);
        
        //error_log("Drawing Card: ".var_export($card, true));
        return $card;
    }

    public function getRemainingCardCount()
    {
        return count($this->deck);
    }

    private function totalRankingHelper($item,$key)
    {
        $this->total += $item->ranking;
    }

    public function countTotalRanking()
    {
        $this->total = 0;
        array_walk($this->deck, array('cardDeck', 'totalRankingHelper'));

        return $this->total;
    }
}


/**
 * 52 cards in 4 suits + 2 optional jokers
 */
class normalCardDeck extends cardDeck
{
    public $suits = array('s' =>"Spades", 'h' => "Hearts", 'c' => "Clubs", 'd' => "Diamonds");
    private $suitsCards = array('2', '3', '4', '5', '6', '7', '8', '9','j', 'q', 'k', 'a');
	private	$namedRanks = array("j"=>"Jack", "q"=>"Queen", "k"=>"King", "a"=>"Ace");
    private $suit2Color = array("Spades" => Card::COLOR2, "Hearts" => Card::COLOR1, "Clubs" => Card::COLOR2, "Diamonds" => Card::COLOR1);
    private $specialCards = array("joker-b" => "Black Joker", "joker-r" => "Red Joker");

    function __construct()
    {
        foreach ($this->suits as $suitAbbrev => $suit) {
            $ranking = 1;
            foreach ($this->suitsCards as $cardnumber) {
                $tempcard = new Card();
                $tempcard->suit = $suit;
                $tempcard->color = $this->suit2Color[$suit];
                $tempcard->name = (isset($this->namedRanks[$cardnumber]) ? $this->namedRanks[$cardnumber] : $cardnumber). ' of '.$suit;
                $tempcard->symbol = $cardnumber;
                $tempcard->ranking = $ranking++;
                $tempcard->image = 'images/normal/'.$cardnumber.'-'.$suitAbbrev.'.png';
                $tempcard->backimage = 'images/normal/facedown.jpg';

                $this->deck[] = $tempcard;
            }
        }

        foreach ($this->specialCards as $abbrev => $name) {
                $tempcard = new Card();
                $tempcard->suit = '';
                $tempcard->color = '';
                $tempcard->name = $name;
                $tempcard->symbol = $abbrev;
                $tempcard->ranking = 0;
                $tempcard->image = 'images/normal/'.$abbrev.'.png';
                $tempcard->backimage = 'images/normal/facedown.jpg';

                $this->deck[] = $tempcard;
        }
    }
}

/**
 * 74 cards: 4 suits, minor + royal arcana
 *           22 cards major arcana
 */
class tarotCardDeck extends cardDeck
{
    public $suits = array('w' => "Wands", 'c' => "Cups", 's' => "Swords", 'p' =>"Pentacles");
    
    // Minor Arcana + Royal Arcana
    public $suitsCards = array('1', '2', '3', '4', '5', '6', '7', '8', '9','10','pa', 'pr', 'q','k');
	public $namedRanks = array('pa' => 'Page', 'pr' => 'Prince', 'q' => 'Queen', 'k' => 'King');
    public $suit2Color = array("Wands" => Card::COLOR2, "Cups" => Card::COLOR1, "Swords" => Card::COLOR2, "Pentacles" => Card::COLOR1);
    
    // Major Arcana
    private $specialCards = array(
        '00' => 'Fool',
        '01' => 'Magician',
        '02' => 'Priestess',
        '03' => 'Empress',
        '04' => 'Emperor',
        '05' => 'Hierophant',
        '06' => 'Lovers',
        '07' => 'Chariot',
        '08' => 'Strength',
        '09' => 'Hermit',
        '10' => 'Wheel',
        '11' => 'Justice',
        '12' => 'Hanged Man',
        '13' => 'Death',
        '14' => 'Temperance',
        '15' => 'Devil',
        '16' => 'Tower',
        '17' => 'Star',
        '18' => 'Moon',
        '19' => 'Sun',
        '20' => 'Judgment',
        '21' => 'World',
    );


    function __construct($use_specials=true)
    {
        $counter = 22;
        foreach ($this->suits as $suitAbbrev => $suit) {
            $ranking = 1;
            foreach ($this->suitsCards as $cardnumber) {
                $tempcard = new Card();
                $tempcard->suit = $suit;
                $tempcard->color = $this->suit2Color[$suit];
                $tempcard->name = (isset($this->namedRanks[$cardnumber]) ? $this->namedRanks[$cardnumber] : $cardnumber). ' of '.$suit;
                $tempcard->symbol = $cardnumber;
                $tempcard->ranking = $ranking++;
                $tempcard->image = 'images/tarot/'.$counter.'.jpg';
                $tempcard->backimage = 'images/tarot/Back.png';

                $this->deck[] = $tempcard;
                $counter++;
            }
        }

        if ($use_specials) {
            foreach ($this->specialCards as $abbrev => $name) {
                    $tempcard = new Card();
                    $tempcard->suit = '';
                    $tempcard->color = '';
                    $tempcard->name = $name;
                    $tempcard->symbol = $abbrev;
                    $tempcard->ranking = 0;
                    $tempcard->image = 'images/tarot/'.$abbrev.'.jpg';
                    $tempcard->backimage = 'images/tarot/Back.png';

                    $this->deck[] = $tempcard;
            }
        }
    }
}
