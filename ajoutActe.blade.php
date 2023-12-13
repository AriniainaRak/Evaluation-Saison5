@extends('navbar.navbarUtilisateur')

@section('titre')
    Ajout Acte
@endsection

@section('content')
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="section-bg">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h3>Saisie d'un acte pour un patient</h3>
            </div>


            <div class="form">
                <form action="{{ route('traitementAjoutActe') }}" method="post" class="php-email-form">
                    @csrf
                    <div class="form-group">
                        <label for="type">Patient</label>
                        <select name="patient" class="form-control">
                            <option value="">Selectionner un patient</option>
                            @foreach ($patient as $item)
                                <option value="{{ $item->id }}">{{ $item->nom }}-{{ $item->adresse }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="daty">Date</label>
                        <input type="date" class="form-control" id="daty" name="daty[]">
                    </div>

                    <div id="mere">
                        <div class="form-group" id="act-container">
                            <div id="act-row">
                                <label for="type">Types</label>
                                <select name="type[]" class="form-control" id="act-select">
                                    <option value="">Selectionner un type</option>
                                    @foreach ($types as $item)
                                        <option value="{{ $item->id }}">{{ $item->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="intitule">Intitule</label>
                            <input type="text" class="form-control" id="intitule" name="intitule[]"
                                placeholder="Intitule">
                        </div>

                        <div class="form-group">
                            <label for="recette">Prix</label>
                            <input type="text" class="form-control" id="recette" name="recette[]"
                                placeholder="Prix recette">
                        </div>

                        <div>
                            <button type="button" onclick="addActeRow()">Ajouter un acte</button>
                        </div>
                    </div>
                    <div class="text-center"><button type="submit">Ajouter</button></div>
                </form>
            </div>

        </div>
    </section><!-- End Contact Section -->


    <script>
        function addActeRow() {
            var mere = document.getElementById('mere');
            console.log(mere);
            var container = document.getElementById('act-container');
            container.classList.add('form-group')
            var rowCount = document.getElementById('act-row').length;

            var newRow = document.createElement('div');
            newRow.classList.add('act-row');

            var selectLabel = document.createElement('label');
            selectLabel.textContent = 'Types';
            newRow.appendChild(selectLabel);

            var selectElement = document.createElement('select');
            selectElement.name = 'type[]';
            selectElement.classList.add('form-control');

            // Copy options from the first select element
            var firstSelectElement = document.getElementById('act-select');
            console.log(firstSelectElement);
            for (var i = 0; i < firstSelectElement.options.length; i++) {
                var option = document.createElement('option');
                option.value = firstSelectElement.options[i].value;
                option.text = firstSelectElement.options[i].text;
                selectElement.appendChild(option);
            }

            newRow.appendChild(selectElement);

            var intituleLabel = document.createElement('label');
            intituleLabel.textContent = 'Intitule';
            mere.appendChild(intituleLabel);

            var intituleInput = document.createElement('input');
            intituleInput.type = 'text';
            intituleInput.name = 'intitule[]';
            intituleInput.classList.add('form-control');
            intituleInput.placeholder = 'Intitule';
            mere.appendChild(intituleInput);

            var recetteLabel = document.createElement('label');
            recetteLabel.textContent = 'Prix';
            mere.appendChild(recetteLabel);

            var recetteInput = document.createElement('input');
            recetteInput.type = 'text';
            recetteInput.name = 'recette[]';
            recetteInput.classList.add('form-control');
            recetteInput.placeholder = 'Prix recette';
            mere.appendChild(recetteInput);

            // container.appendChild(newRow);
            mere.appendChild(newRow);
        }
    </script>
@endsection
