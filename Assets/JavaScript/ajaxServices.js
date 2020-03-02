/*
 * The document ready function which runs automatically after the HTML page is loaded.
 */
$(function()
    {
        //set up the click handler of the search button.
        $("#addTubular").click(function()
            {
                addTubularToDatabase();
            }
        );

        //populate checkbox lists after the page is loaded.
        //populateTubularCheckBoxList();
        //populateToolCheckBoxList();

    } //end document ready function
);

/*
 *Function to handle search button.
 */
function addTubularToDatabase()
{
    var tubularOD=$("#tubularOD").val();
    var tubularID=$("#tubularID").val();
    var weight=$("#weight").val();

    var url="./Assets/AjaxServices/AddTubular.php";
    var data={  "tubularOD":tubularOD,
                "tubularID":tubularID,
                "weight":weight
                };   //request parameters as a map

    //send Ajax request
    $.post(url, data, function(result){
        alert(result.message);
    });

    // populateTubularCheckBoxList();

} //end function

/*
Function to populate tubular checkbox list
 */
function populateTubularCheckBoxList(keyword)
{

} //end function
