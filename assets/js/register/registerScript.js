$(document).ready(function() {
    // Hacer una solicitud AJAX para obtener los nombres de los centros
    $.ajax({
        url: './modelo/centro_formativo.php',
        type: 'GET',
        dataType: 'json',
        success: function(data) {
            // Volcar los nombres de los centros al select
            var select = $('#centro');
            $.each(data, function(key, value) {
                select.append('<option value="' + value.ID_Centro_Formativo + '">' + value.Nombre + '</option>');
            });
        },
        error: function(xhr, status, error) {
            console.error('Error al obtener los centros:', status, error);
        }
    });
});