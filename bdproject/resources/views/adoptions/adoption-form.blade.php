@extends('layouts.app')

@section('content')



    <style>
        .cat-form-wrapper {
            display: flex;
            max-width: 1000px;
            margin: 3rem auto;
            background-color: #f7fff7;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            height:auto;
        }

        .cat-form-image {
            flex: 2;
            background: url('{{ asset('images/adopt.png') }}')  center center;
            background-color: #eee2c3;
            background-size: cover;

        }


        .cat-form-content {
            flex: 1.5;
            padding: 2.5rem;
            background-color: #7b9774;
        }

        .cat-form-title {
            font-size: 1.75rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: left;
            color: #4e3b3b;
        }

        .cat-label {
            font-weight: bold;
            color: #4e3b3b;
            margin: 1rem 0 0.25rem;
            display: block;
        }

        .cat-input,
        .cat-select,
        .cat-textarea {
            width: 100%;
            padding: 0.75rem;
            border-radius: 10px;
            border: 1px solid #ccc;
            margin-bottom: 1rem;
            background-color: white;
        }

        .cat-section-title {
            font-size: 1.25rem;
            margin: 2rem 0 1rem;
            font-weight: bold;
            color: #4e3b3b;
        }

        .cat-radio-group {
            margin-bottom: 1.5rem;
        }

        .cat-radio {
            display: inline-block;
            margin-right: 1.5rem;
            color: #4e3b3b;
        }

        .cat-radio input {
            margin-right: 0.5rem;
        }

        .cat-btn-submit {
            background-color: #7f6a75;
            border: none;
            padding: 0.75rem;
            width: 100%;
            border-radius: 10px;
            font-weight: bold;
            color: white;
            margin-top: 2rem;
            cursor: pointer;
        }

        .cat-btn-submit:hover {
            background-color: #6e5c66;
        }

        .cat-radio input[type="radio"],
        input[type="checkbox"] {
            accent-color: #7f6a75;
            width: 18px;
            height: 18px;
            cursor: pointer;
            vertical-align: middle;
            margin-right: 8px;
        }
        .cat-textarea {
            resize: vertical;
            min-height: 100px;
            font-family: inherit;
            font-size: 1rem;
            box-shadow: inset 1px 1px 5px rgba(0,0,0,0.1);
            transition: border 0.3s ease, box-shadow 0.3s ease;
        }

        .cat-textarea:focus {
            outline: none;
            border: 1px solid #7f6a75;
            box-shadow: 0 0 6px #7f6a7577;
        }
        .cat-radio input[type="radio"]:checked + label,
        input[type="checkbox"]:checked + label {
            font-weight: bold;
            color: #4e3b3b;
        }

    </style>

    <div class="cat-form-wrapper">
        <div class="cat-form-image"></div>
        <div class="cat-form-content">
            <h2 class="cat-form-title">Formular de Adopție</h2>

            @if (session('message'))
                <div style="text-align:center; padding: 10px; background-color: #d4edda; color: #155724; border-radius: 8px;">
                    {{ session('message') }}
                </div>
            @endif

            <form id="adoptionForm" method="POST" action="{{ route('adoption.submit') }}">
                @csrf

                <label class="cat-label" for="post_id">Alege pisica:</label>
                <select name="post_id" id="post_id" class="cat-select">
                    <option value="">-- Selectează o pisică --</option>
                    @foreach($posts as $post)
                        <option value="{{ $post->id }}" {{ (isset($post_id) && $post_id == $post->id) ? 'selected' : '' }}>
                            {{ $post->title }}
                        </option>
                    @endforeach
                </select>

                <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                <div class="cat-section-title">Date Personale</div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="cat-label">Numele complet:</label>
                        <input type="text" name="full_name" class="cat-input" minlength="3" maxlength="255" required>
                    </div>

                    <div class="col-md-6">
                        <label class="cat-label">Adresa ta de email:</label>
                        <input type="email" name="email" class="cat-input" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="cat-label">Numărul tău de telefon:</label>
                        <input type="text" name="phone" class="cat-input" pattern="^[0-9\s\-\+\(\)]{7,20}$" required>
                    </div>

                    <div class="col-md-6">
                        <label class="cat-label">Adresa completă:</label>
                        <input type="text" name="address" class="cat-input" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <label class="cat-label">Oraș și județ:</label>
                        <input type="text" name="city_state" class="cat-input" required>
                    </div>

                    <div class="col-md-6">
                        <label class="cat-label">Ocupația:</label>
                        <input type="text" name="occupation" class="cat-input" required>
                    </div>
                </div>


                <div class="cat-section-title">Informații despre Locuință</div>

                <label class="cat-label">Tipul de locuință:</label>
                <select name="housing_type" class="cat-select" required>
                    <option value="Apartament">Apartament</option>
                    <option value="Casă">Casă</option>
                    <option value="Altceva">Altceva</option>
                </select>

                <label class="cat-label">Locuința este proprietatea ta?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="is_owner" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="is_owner" value="0" required> Nu</label>
                </div>

                <label class="cat-label">Ai permisiunea proprietarului să ții animale?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="rental_pet_permission" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="rental_pet_permission" value="0" required> Nu</label>
                </div>

                <label class="cat-label">Există cineva în casa ta alergic la pisici?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="household_allergy" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="household_allergy" value="0" required> Nu</label>
                </div>

                <label class="cat-label">Locuința ta are un spațiu sigur pentru pisică?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="secure_space" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="secure_space" value="0" required> Nu</label>
                </div>

                <label class="cat-label">Cât de des este cineva acasă?</label>
                <select name="home_presence" class="cat-select" required>
                    <option value="Tot timpul">Tot timpul</option>
                    <option value="În majoritatea timpului">În majoritatea timpului</option>
                    <option value="Doar seara">Doar seara</option>
                    <option value="Aproape niciodată">Aproape niciodată</option>
                </select>

                <div class="cat-section-title">Experiența cu Animalele</div>

                <label class="cat-label">Ai mai avut animale de companie?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="had_pets_before" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="had_pets_before" value="0" required> Nu</label>
                </div>

                <label class="cat-label">Dacă da, ce s-a întâmplat cu ele?</label>
                <textarea name="past_pets_details" class="cat-textarea"></textarea>

                <label class="cat-label">Ai alte animale acasă?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="has_other_pets" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="has_other_pets" value="0" required> Nu</label>
                </div>

                <label class="cat-label">Dacă da, care sunt acestea?</label>
                <div class="d-flex flex-wrap gap-2 mb-3">
                    <div class="form-check me-3">
                        <input type="checkbox" name="other_pets[]" value="dog" class="form-check-input">
                        <label class="form-check-label">Câine</label>
                    </div>
                    <div class="form-check me-3">
                        <input type="checkbox" name="other_pets[]" value="cat" class="form-check-input">
                        <label class="form-check-label">Pisică</label>
                    </div>
                    <div class="form-check me-3">
                        <input type="checkbox" name="other_pets[]" value="birds" class="form-check-input">
                        <label class="form-check-label">Păsări</label>
                    </div>
                    <div class="form-check me-3">
                        <input type="checkbox" name="other_pets[]" value="fish" class="form-check-input">
                        <label class="form-check-label">Pești</label>
                    </div>
                    <div class="form-check me-3">
                        <input type="checkbox" name="other_pets[]" value="other" class="form-check-input">
                        <label class="form-check-label">Alte</label>
                    </div>
                </div>


                <div class="cat-section-title">Motivația Adopției</div>

                <label class="cat-label">De ce vrei să adopți o pisică?</label>
                <textarea name="adoption_reason" class="cat-textarea" required></textarea>

                <label class="cat-label">Cunoști costurile asociate cu îngrijirea unei pisici?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="understands_costs" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="understands_costs" value="0" required> Nu</label>
                </div>

                <label class="cat-label">Ai mai adoptat o pisică înainte?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="previous_adoption" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="previous_adoption" value="0" required> Nu</label>
                </div>

                <label class="cat-label">Dacă da, ce s-a întâmplat cu ea?</label>
                <textarea name="previous_adoption_details" class="cat-textarea"></textarea>


                <div class="cat-section-title">Responsabilități</div>

                <label class="cat-label">Cine va avea grijă de pisică în timpul vacanțelor?</label>
                <input type="text" name="vacation_care" class="cat-input" required>

                <label class="cat-label">Dacă trebuie să renunți la pisică, ce vei face?</label>
                <textarea name="surrender_plan" class="cat-textarea" required></textarea>

                <label class="cat-label">Ești de acord să acoperi costurile veterinare?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="covers_vet_expenses" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="covers_vet_expenses" value="0" required> Nu</label>
                </div>

                <label class="cat-label">Dacă apar probleme de comportament, ești dispus să lucrezi cu un specialist?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="willing_to_train" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="willing_to_train" value="0" required> Nu</label>
                </div>


                <div class="cat-section-title">Consimțământ</div>

                <label class="cat-label">Ești de acord cu vizite de verificare după adopție?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="agrees_home_visits" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="agrees_home_visits" value="0" required> Nu</label>
                </div>

                <label class="cat-label">Confirmi că adopția este un angajament pe termen lung?</label>
                <div class="cat-radio-group">
                    <label class="cat-radio"><input type="radio" name="understands_commitment" value="1" required> Da</label>
                    <label class="cat-radio"><input type="radio" name="understands_commitment" value="0" required> Nu</label>
                </div>

                <div class="cat-radio-group" style="margin-top: 1rem;">
                    <input type="checkbox" name="accepts_terms" value="1" required>
                    <label class="cat-label" style="display: inline; font-weight: normal;">Accept termenii adopției</label>
                </div>

                <label class="cat-label" style="margin-top: 1rem;">Dacă crezi că mai e ceva ce trebuie să știm:</label>
                <textarea name="additional_info" class="cat-textarea"></textarea>


                <button type="submit" class="cat-btn-submit">Trimite cererea</button>
            </form>
        </div>
    </div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const emailInput = document.querySelector('input[name="email"]');
        const emailError = document.createElement('div');
        emailError.style.color = '#b00020';
        emailInput.insertAdjacentElement('afterend', emailError);

        emailInput.addEventListener('input', function () {
            const emailValue = emailInput.value;
            const emailPattern = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
            if (!emailPattern.test(emailValue)) {
                emailError.textContent = 'Te rugăm să introduci un email valid.';
            } else {
                emailError.textContent = '';
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const phoneInput = document.querySelector('input[name="phone"]');
        const phoneError = document.createElement('div');
        phoneError.style.color = '#b00020';
        phoneInput.insertAdjacentElement('afterend', phoneError);

        phoneInput.addEventListener('input', function () {
            const phoneValue = phoneInput.value;
            const phonePattern = /^[0-9\s\-\+\(\)]{7,20}$/;
            if (!phonePattern.test(phoneValue)) {
                phoneError.textContent = 'Numărul de telefon este invalid. Asigură-te că folosești doar cifre.';
            } else {
                phoneError.textContent = '';
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const nameInput = document.querySelector('input[name="full_name"]');
        const nameError = document.createElement('div');
        nameError.style.color = '#b00020';
        nameInput.insertAdjacentElement('afterend', nameError);

        nameInput.addEventListener('input', function () {
            const nameValue = nameInput.value;
            if (nameValue.length < 3) {
                nameError.textContent = 'Numele trebuie să conțină cel puțin 3 caractere.';
            } else {
                nameError.textContent = '';
            }
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('adoptionForm');

        form.addEventListener('submit', function (event) {
            let valid = true;

            const emailInput = document.querySelector('input[name="email"]');
            if (!emailInput.value.match(/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/)) {
                valid = false;
                alert('Te rugăm să introduci un email valid.');
            }

            const phoneInput = document.querySelector('input[name="phone"]');
            if (!phoneInput.value.match(/^[0-9\s\-\+\(\)]{7,20}$/)) {
                valid = false;
                alert('Te rugăm să introduci un număr de telefon valid.');
            }

            if (!valid) {
                event.preventDefault();
            }
        });
    });



</script>

