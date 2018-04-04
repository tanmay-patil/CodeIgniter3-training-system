/**
Created on : 19th March 2018
By : Tanmay Patil
Description : This JS File contains all the functions related to
Test Case Status : Not Implemented yet.
*/

/**
 * @param null
 * @returns null
 */
function CreateTest() {

    /**
     * @param { null }
     * @returns { null }
     */
    this.addEventToTab = function() {

        $(ci_tab_new_test).on("click", function() {
            alert("ok");
        });

    };

    /**
     * @param { null }
     * @returns { null }
     */
    this.newQuestion = function() {

        // Get current total number of questions in test container
        var newQuestionId = document.getElementById("ci_form_test_container").childElementCount + 1;

        // Append new question with new question id to the test container
        this.appendNewQuestion(newQuestionId);

        // Scroll to the bottom
        scrollToBottom();

    };

    /**
     * @param { null }
     * @returns { null }
     */
    this.appendNewQuestion = function(id) {

        try {
            $(ci_form_test_container).append(`<div class="ci-card-container ci-form-question-container">
            <div class="row">
                <div class="col-sm-10">
                    <div class="ci-form-question-text">
                        <div class="row">
                            <div class="col-sm-3">
                                Q.` + id + `
                            </div>
                            <div class="col-sm-9">
                                <span class="float-right">Delete</span>
                            </div>
                        </div>
                    
                        <textarea class="form-control ci-form-question-input" rows="5" placeholder="Question text goes here.."></textarea>
                    </div>
                    <br/>

                    <div class="ci-form-option">
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="radio" name="ci_radio_` + id + `">
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Option 1 text goes here..">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="radio" name="ci_radio_` + id + `">
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Option 2 text goes here..">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="radio" name="ci_radio_` + id + `">
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Option 3 text goes here..">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="radio" name="ci_radio_` + id + `">
                            </div>
                            <div class="col-sm-7">
                                <input type="text" class="form-control" placeholder="Option 4 text goes here..">
                            </div>
                        </div>
                        <br/>
                    </div>
                </div>
            </div>
        </div>`);
        } catch (error) {
            console.log(error);
        }


    };

    /**
     * @param { null }
     * @returns { null }
     */
    this.save = function() {

        // Data to be sent to the controller
        var test_json = {};
        var userList = [];

        // Fetch header block data
        var headerObject = this.getHeader();

        // Fetch question set in object format
        var questionSetObject = this.getQuestionSet();

        // Add it to final test json object
        test_json.header = headerObject;
        test_json.question_set = questionSetObject;

        console.log(test_json);
    };

    /** 
     * @param { null }
     * @returns { object }
     */
    this.getHeader = function() {
        var response = {};
        response.created_by = "";
        response.test_name = document.getElementById("ci_form_topic");
        response.duration_hours = document.getElementById("ci_form_duration");
        response.min_passing_marks = document.getElementById("ci_form_passing_marks");

        return response;
    };

    /**
     * @param { null }
     * @returns { objct }
     */
    this.getQuestionSet = function() {
        try {

            var response = [];

            // Traverse for every question
            var testContainerChildren = document.getElementById("ci_form_test_container");
            for (var i = 0; i < testContainerChildren.childElementCount; i++) {
                var questionElement = testContainerChildren.children[i];
                var questionObject = this.getQuestionObject(questionElement);
                response.push(questionObject);
            }

            return response;

        } catch (error) {
            console.log(error);
        }
    };

    /**
     * @param { null }
     * @returns { null }
     */
    this.getQuestionObject = function(questionElement) {
        try {
            var response = {};
            response.questionText = $(questionElement).find(".ci-form-question-input").val();
            response.correctOptionId = [1];
            response.options = this.getOptionsObject();

            return response;

        } catch (error) {
            console.log(error);
        }
    };

    /**
     * @param { null }
     * @returns { Array }
     */
    this.getOptionsObject = function() {
        try {
            var response = [];



        } catch (error) {
            console.log(error);
        }
    };



}