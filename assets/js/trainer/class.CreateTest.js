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

}