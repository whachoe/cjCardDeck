cjCardDeck
==========

A couple of php-classes that implement a playing card deck. There is 1 base class and 2 different flavours (normal card game and a tarot-game).


Class card
----------
#### Properties
- public $suit      :  The suit of the card
- public $color     :  The color of the card
- public $name      :  Name of the card
- public $symbol    :  The number or symbol of the card
- public $ranking   :  The overal ranking of this card in its suit
- public $image     :  The image for this card
- public $backimage :  The image of the backside of the card

#### Methods
- getImgTag()       :  Gives back an image tag for this card
- getBackImgTag()   :  Gives back the image tag for the back of this card



Class cardDeck
-------
#### Properties

none you will have to use directly

#### Methods
- cardDeck->shuffle: Shuffles the deck
- cardDeck->drawCard: Draw 1 card and removes it from the deck
- cardDeck->getRemainingCardCount: Get the amount of remaining cards in the deck
- cardDeck->countTotalRanking: Get the total value of all the cards that are still in the deck


Acknowledgements:
---------
- Credit to Anthony J Clink for the card pictures he provided in his implementation.
  http://www.phpclasses.org/package/4976-PHP-Manipulate-decks-of-cards.html
- Orphalese.net for making a great tarot-dealing program and making it possible to create and share new tarot-decks.


Contact Jo Giraerts <jo.giraerts@gmail.com> for more information
