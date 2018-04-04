$(window).on("load", function() {


});

function addNewQuestion() {
    var createTestObj = new CreateTest();
    createTestObj.newQuestion();
}

function saveNewTest() {
    var createTestObj = new CreateTest();
    createTestObj.save();
}