<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Populate City Dropdown Using jQuery Ajax</title>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
$(document).ready(function(){
    $("select.district").change(function(){
        var selectedCountry = $(".district option:selected").val();
        $.ajax({
            type: "POST",
            url: "process-request.php",
            data: { district : selectedCountry }
        }).done(function(data){
            $("#response").html(data);
        });
    });
});
</script>
</head>
<body>
<form action="districtinsert.php" method="POST">
    <table>
        <tr>
            <td>
                <label>District:</label>
                <select class="district" name="district">
                    <option>Select</option>
                    <option value="Alapuzha">Alapuzha</option>
                    <option value="Ernakulam">Ernakulam</option>
                    <option value="Idukki">Idukki</option>
                    <option value="Kannur">Kannur</option>
                    <option value="Kasargode">Kasargode</option>
                    <option value="Kollam">Kollam</option>
                    <option value="Kottayam">Kottayam</option>
                    <option value="Kozhikode">Kozhikode</option>
                    <option value="Malappuram">Malappuram</option>
                    <option value="Palakkad">Palakkad</option>
                    <option value="Pathanmthitta">Pathanmthitta</option>
                    <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                    <option value="Thrissur">Thrissur</option>
                    <option value="Wayanad">Wayanad</option>      
                </select>
            </td>
            <td>
                <label>Section:</label>
                <select id="response" name="section">
                    <option>--Select--</option>
                </select>
            </td>

        </tr>
    </table>
    <input type="submit" value="Submit">
</form>
</body>
</html>
