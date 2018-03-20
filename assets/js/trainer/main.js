$(window).on("load", function() {

    // On load code for TRAINER HOME goes here

    // CreateTest
    var createTestObj = new CreateTest();
    createTestObj.addEventToTab();

    // CreateTraining
    var createTrainingObj = new CreateTraining();
    createTrainingObj.addEventToTab();

});