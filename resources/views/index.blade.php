<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora de Viaje</title>
    <!-- Incluir jQuery desde un CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="selection-screen">
        <h2>Calculadora de Viaje</h2>
        <form id="travel-form">
            @csrf
            <label for="city">Selecciona una ciudad:</label>
            <select name="city" id="city" required>
                <option value="" disabled selected hidden>Seleccione ...</option>
                @foreach ($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>

            <br/><br/>

            <label for="budget">Ingresa tu presupuesto en COP:</label>
            <input type="number" id="budget" name="budget" required>

            <button type="submit">Calcular</button>
        </form>
    </div>

    <div id="result-screen" style="display: none;">
        <h2>Resultados del Viaje</h2>
        <p><strong>Ciudad:</strong> <span id="selected-city"></span></p>
        <p><strong>Clima:</strong> <span id="temperature"></span>°C</p>
        <p><strong>Moneda Local:</strong> <span id="currency_name"></span> (<span id="currency_symbol"></span>)</p>
        <p><strong>Presupuesto Convertido:</strong> <span id="budget_in_local_currency"></span></p>
        <p><strong>Tasa de Cambio:</strong> <span id="exchange_rate"></span></p>
        <br>
        <button id="back">Volver</button>
    </div>

    <script>
        $(document).ready(function() {
            // Manejo del formulario de viaje
            $('#travel-form').on('submit', function(e) {
                e.preventDefault();

                // Obtener los valores de la ciudad y el presupuesto
                const city = $('#city').val();
                const budget = $('#budget').val();

                $.ajax({
                    url: '/calculate',
                    method: 'POST',
                    data: {
                        city: city,
                        budget: budget,
                        _token: '{{ csrf_token() }}' // Para la protección CSRF en Laravel
                    },
                    success: function(res) {
                        // Mostrar la Pantalla 2 con los resultados
                        $('#selected-city').text($("#city option:selected").text());
                        $('#temperature').text(res.temperature);
                        $('#currency_name').text(res.currency_name);
                        $('#currency_symbol').text(res.currency_symbol);
                        $('#budget_in_local_currency').text(res.currency_symbol + res.budget_in_local_currency);
                        $('#exchange_rate').text(res.exchange_rate);

                        $('#selection-screen').hide();
                        $('#result-screen').show();
                    }
                });
            });

            // Botón para volver a la pantalla de selección
            $('#back').on('click', function() {
                $('#result-screen').hide();
                $('#selection-screen').show();
            });
        });
    </script>

</body>
</html>
