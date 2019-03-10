const memoryGame = {
    tileCount : 20, //liczba klocków
    tileOnRow : 5, //liczba klocków na rząd
    divBoard : null, //div z planszą gry
    divScore : null, //div z wynikiem gry
    tiles : [], //tutaj trafi wymieszana tablica klocków
    tilesChecked : [], //zaznaczone klocki
    moveCount : 0, //liczba ruchów
    tilesImg : [ //grafiki dla klocków
        'images/tile_1.png',
        'images/tile_2.png',
        'images/tile_3.png',
        'images/tile_4.png',
        'images/tile_5.png',
        'images/tile_6.png',
        'images/tile_7.png',
        'images/tile_8.png',
        'images/tile_9.png',
        'images/tile_10.png'
    ],
    canGet : true, //czy można klikać na kafelki
    tilePairs : 0, //liczba dopasowanych kafelkow

    tileClick : function(e) {
        if (this.canGet) {
            //jeżeli jeszcze nie pobraliśmy 1 elementu
            //lub jeżeli index tego elementu nie istnieje w pobranych...
            if (!this.tilesChecked[0] || (this.tilesChecked[0].dataset.index !== e.target.dataset.index)) {
                this.tilesChecked.push(e.target);
                e.target.style.backgroundImage = 'url(' + this.tilesImg[e.target.dataset.cardType] + ')';
            }

            if (this.tilesChecked.length === 2) {
                this.canGet = false;

                if (this.tilesChecked[0].dataset.cardType === this.tilesChecked[1].dataset.cardType) {
                    setTimeout(this.deleteTiles.bind(this), 500);
                } else {
                    setTimeout(this.resetTiles.bind(this), 500);
                }
                this.moveCount++;
                this.divScore.innerHTML = this.moveCount;
            }
        }
    },

    deleteTiles : function() {
        this.tilesChecked[0].remove();
        this.tilesChecked[1].remove();

        this.canGet = true;
        this.tilesChecked = [];

        this.tilePairs++;

        if (this.tilePairs >= this.tileCount / 2) {
            $(".form-control").attr("value", this.moveCount);
            $('#gameoverModal').modal('show');
        }
    },

    resetTiles : function() {
        this.tilesChecked[0].style.backgroundImage = 'url(images/tile.png)';
        this.tilesChecked[1].style.backgroundImage = 'url(images/tile.png)';

        this.tilesChecked = [];
        this.canGet = true;
    },

    startGame : function() {
        //zamiana tekstu na przycisku
        $(".game-start").html("Reset game");

        //czyścimy planszę
        this.divBoard = document.querySelector('.game-board');
        this.divBoard.innerHTML = '';

        //czyścimy wynik
        this.divScore = document.querySelector('#movesValue');
        this.divScore.innerHTML = '0';

        //czyścimy zmienne (bo gra może się zacząć ponownie)
        this.tiles = [];
        this.tilesChecked = [];
        this.moveCount = 0;

        this.canGet = true;
        this.tilePairs = 0;

        //generujemy tablicę numerów kocków (parami)
        for (let i=0; i<this.tileCount; i++) {
            this.tiles.push(Math.floor(i/2));
        }

        //i ją mieszamy
        for (let i=this.tileCount-1; i>0; i--) {
            const swap = Math.floor(Math.random()*i);
            const tmp = this.tiles[i];
            this.tiles[i] = this.tiles[swap];
            this.tiles[swap] = tmp;
        }

        for (let i=0; i<this.tileCount; i++) {
            const tile = document.createElement('div');
            tile.classList.add("game-tile");
            this.divBoard.appendChild(tile);

            tile.dataset.cardType = this.tiles[i];
            tile.dataset.index = i;
            tile.style.left = 5+(tile.offsetWidth+5)*(i%this.tileOnRow) + 'px';
            tile.style.top = 5+(tile.offsetHeight+5)*(Math.floor(i/this.tileOnRow)) + 'px';

            tile.addEventListener('click', this.tileClick.bind(this));
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.game-start').addEventListener('click', function() {
        memoryGame.startGame();
    });
});


// Ajax Call for the game over form
// Once the form is submitted
$("#gameoverform").submit(function(event){
    // prevent default php processing
    event.preventDefault();
    // collect user inputs
    var datatopost = $(this).serializeArray();
    // console.log(datatopost);
    // send them to forgotpassword.php using AJAX
        // $.post({}).done().fail(); Alternative method for ajax call
        // $.get().done().fail(); Alternative method for ajax call
    $.ajax({
        url: "score.php",
        type: "POST",
        data: datatopost,
        success: function(data){
            $("#gameovermessage").html("<div class='alert alert-success'>Poprawnie zapisano wynik</div>");
            setTimeout(function(){ window.location = "http://mpaczocha.pl/memoryGame.php"; $('#gameoverModal').modal('hide');}, 1000);
        },
        error: function(){
            $("#gameovermessage").html("<div class='alert alert-danger'>There was an error with the Ajax Call. Please try again later</div>");
        },
    });
});

// document.querySelector('#submit').addEventListener('click', function() {
//     memoryGame.startGame()});


