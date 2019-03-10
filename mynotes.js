$(function(){
    // Define variables
    var activeNote = 0;
    var editMode = false;

    // Load notes on page load: Ajax call to loadnotes.php
    $.ajax({
        url: "loadnotes.php",
        success: function(data){
            $("#notes").html(data);
            clickonNote();
            clickonDelete();
        },
        error: function(){
            $('#alertContent').text("There was an error with the Ajax Call. Please try again later!");
            $('#alert').fadeIn();
        },
    });

    // Add a new notes: Ajax call to createnote.php
    $('#addNote').click(function(){
        $.ajax({
            url: "createnote.php",
            success: function(data){
                if(data == 'error'){
                    $('#alertContent').text("There was an issue inserting the new note in the database!");
                    $('#alert').fadeIn();
                }else{
                    //Update activeNote to the id of the new note
                    activeNote = data;
                    $('textarea').val('');
                    //Show hide elements
                    showHide(["#notePad", "#saveNote"],["#notes", "#addNote", "#edit", "#done"]);
                    $('textarea').focus();
                }
            },
            error: function(){
                $('#alertContent').text("There was an error with the Ajax Call. Please try again later!");
                $('#alert').fadeIn();
            },
        });
    });

    // Type note: Ajax call to updatenote.php
    $('textarea').keyup(function(){
        //Ajax call to update the task of id activenote
        $.ajax({
            url: "updatenote.php",
            type: "POST",
            //We need to send the current note content with its id to the php file
            data: {note: $(this).val(), id: activeNote},
            success: function(data){
                if(data == 'error'){
                    $('#alertContent').text("There was an issue updating the note in the database!");
                    $('#alert').fadeIn();
                }
            },
            error: function(){
                $('#alertContent').text("There was an error with the Ajax Call. Please try again later!");
                $('#alert').fadeIn();
            },
        });
    });

    // Click on save note button
    $('#saveNote').click(function(){
        $.ajax({
            url: "loadnotes.php",
            success: function(data){
                $("#notes").html(data);
                showHide(["#addNote", "#edit", "#notes"],["#saveNote", "#notePad"]);
                clickonNote();
                clickonDelete();
            },
            error: function(){
                $('#alertContent').text("There was an error with the Ajax Call. Please try again later!");
                $('#alert').fadeIn();
            },
        });
    });

    // Click on done after editing: load notes again
    $('#done').click(function(){
        editMode = false;

        //expand notes
        $('.noteheader').removeClass('col-xs-7 col-sm-9');

        //show hide elements
        showHide(['#edit'],[this, '.delete']);
    });

    // Click on edit button: go to edit mode(show delete buttons, ...)
    $('#edit').click(function(){
        //switch to edit mode
        editMode = true;

        //reduce the width of notes
        $('.noteheader').addClass('col-xs-7 col-sm-9');
        showHide(["#done", ".delete"], [this]);

    });

    // Functions
        // click on a note
        function clickonNote(){
            $('.noteheader').click(function(){
                if(!editMode){
                    //Update our activeNote variable to id of a note
                    activeNote = $(this).attr("id");

                    //Fill a textarea
                    $('textarea').val($(this).find('.text').text());

                    //Show hide elements
                    showHide(["#notePad", "#saveNote"],["#notes", "#addNote", "#edit", "#done"]);
                    $('textarea').focus();
                }
            });
        }
        // click on delete
        function clickonDelete(){
            $('.delete').click(function(){
                var deleteButton = $(this);

                //send ajax call to delete note
                $.ajax({
                    url: "deletenote.php",
                    type: "POST",
                    //We need to send the id of the note to be deleted
                    data: {id: deleteButton.next().attr("id")},
                    success: function(data){
                        if(data == 'error'){
                            $('#alertContent').text("There was an issue deleting the note from the database!");
                            $('#alert').fadeIn();
                        }else{
                            //remove containing div
                            deleteButton.parent().remove();
                        }
                    },
                    error: function(){
                        $('#alertContent').text("There was an error with the Ajax Call. Please try again later!");
                        $('#alert').fadeIn();
                    },
                });
            });
        }

        // showHide function

        function showHide(array1, array2){
            for(i=0; i<array1.length; i++){
                $(array1[i]).show();
            }
            for(i=0; i<array2.length; i++){
                $(array2[i]).hide();
            }
        }
});