<?php
$countries = include 'getCountries.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Country and City List</title>
    <h1>Выберите страну</h1>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<label for="countrySelect"></label><select id="countrySelect">
    <option value="">Выберите страну</option>
    <?php foreach ($countries as $country): ?>
        <option value="<?= htmlspecialchars($country['id']) ?>"><?= htmlspecialchars($country['country']) ?></option>
    <?php endforeach; ?>
</select>

<table id="cityTable" style="margin-top: 20px; display: none;">
    <thead>
    <tr>
        <th>City</th>
    </tr>
    </thead>
    <tbody></tbody>
</table>

<script>
    $(document).ready(function(){
        $('#countrySelect').change(function(){
            let countryId = $(this).val();
            if (countryId) {
                $.ajax({
                    url: 'getCities.php',
                    type: 'GET',
                    data: {countryid: countryId},
                    success: function(data) {
                        $('#cityTable tbody').html(data);
                        $('#cityTable').show();
                    }
                });
            } else {
                $('#cityTable tbody').html('');
                $('#cityTable').hide();
            }
        });
    });
</script>
</body>
</html>
