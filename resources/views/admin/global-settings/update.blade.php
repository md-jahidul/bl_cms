@extends('layouts.admin')
@section('title', 'Settings')
@section('card_name', 'Global Settings')

@section('content')
    <div class="container">
        <h1>Edit Setting</h1>
        <form method="POST" action="{{ route('global-settings.update', $settings) }}" id="settingsForm">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="settings_key">Setting Key</label>
                <input type="text" class="form-control" id="settings_key" name="settings_key" required
                       value="{{ $settings->settings_key }}">
                <div id="settings_key_error" style="color: red;"></div>
            </div>

            <div class="form-group">
                <label for="value_type">Value Type</label>
                <select class="form-control" id="value_type" name="value_type" required>
                    <option value="number" @if ($settings->value_type === 'number') selected @endif>Number</option>
                    <option value="string" @if ($settings->value_type === 'string') selected @endif>String</option>
                    <option value="json" @if ($settings->value_type === 'json') selected @endif>JSON</option>
                    <option value="boolean" @if ($settings->value_type === 'boolean') selected @endif>Boolean</option>
                </select>
            </div>

            <div class="form-group" id="number_input"
                 @if ($settings->value_type !== 'number') style="display: none;" @endif>
                <label for="number_value">Number Value</label>
                <input type="number" class="form-control" id="number_value" name="number_value"
                       value="{{ $settings->settings_value }}">
            </div>

            <div class="form-group" id="string_input"
                 @if ($settings->value_type !== 'string') style="display: none;" @endif>
                <label for="string_value">String Value</label>
                <input type="text" class="form-control" id="string_value" name="string_value"
                       value="{{ $settings->settings_value }}">
            </div>

            <div class="form-group" id="boolean_input"
                 @if ($settings->value_type !== 'boolean') style="display: none;" @endif>
                <label for="boolean_value">Boolean Value</label>
                <input type="text" class="form-control" id="boolean_value" name="boolean_value"
                       value="{{ $settings->settings_value }}">
                <div id="boolean_error" style="color: red;"></div>
            </div>

            <div class="form-group" id="json_input"
                 @if ($settings->value_type !== 'json') style="display: none;" @endif>
                <label for="json_value">JSON Value</label>
                <textarea class="form-control" id="json_value" name="json_value"
                          rows="4">{{ $settings->settings_value }}</textarea>
                <div id="json_error" style="color: red;"></div>
            </div>
            <div id="settings_value_error" style="color: red;"></div>

            <div class="form-group">
                <label for="android_min">Android Min</label>
                <input type="number" class="form-control" id="android_min" name="android_min"
                       value="{{ $settings->android_min }}">
            </div>

            <div class="form-group">
                <label for="android_max">Android Max</label>
                <input type="number" class="form-control" id="android_max" name="android_max"
                       value="{{ $settings->android_max }}">
            </div>

            <div class="form-group">
                <label for="ios_min">iOS Min</label>
                <input type="number" class="form-control" id="ios_min" name="ios_min" value="{{ $settings->ios_min }}">
            </div>

            <div class="form-group">
                <label for="ios_max">iOS Max</label>
                <input type="number" class="form-control" id="ios_max" name="ios_max" value="{{ $settings->ios_max }}">
            </div>

            <div class="form-group">
                <label for="start_time">Start Time</label>
                <input type="datetime-local" class="form-control" id="start_time" name="start_time" value="{{ $settings->start_time }}">
            </div>

            <div class="form-group">
                <label for="end_time">End Time</label>
                <input type="datetime-local" class="form-control" id="end_time" name="end_time" value="{{ $settings->end_time }}">
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select class="form-control" id="status" name="status" readonly="true" disabled>
                    <option value="1" @if ($settings->status == 1) selected @endif>True</option>
                    <option value="0" @if ($settings->status == 0) selected @endif>False</option>
                </select>
            </div>

            <button type="button" class="btn btn-primary" id="updateSetting">Update Setting</button>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const settings_key = document.getElementById('settings_key');
            const valueTypeSelect = document.getElementById('value_type');
            const numberInput = document.getElementById('number_input');
            const stringInput = document.getElementById('string_input');
            const booleanInput = document.getElementById('boolean_input');
            const booleanValueInput = document.getElementById('boolean_value');
            const booleanError = document.getElementById('boolean_error');
            const jsonInput = document.getElementById('json_input');
            const jsonValueInput = document.getElementById('json_value');
            const jsonError = document.getElementById('json_error');
            const settingsKeyError = document.getElementById('settings_key_error');
            const settingsValueError = document.getElementById('settings_value_error');
            const updateSettingButton = document.getElementById('updateSetting');
            const settingsForm = document.getElementById('settingsForm');

            // Function to show Number input
            function showNumberInput() {
                hideAllInputs();
                numberInput.style.display = 'block';
            }

            // Function to show String input
            function showStringInput() {
                hideAllInputs();
                stringInput.style.display = 'block';
            }

            function showBooleanInput() {
                hideAllInputs();
                booleanInput.style.display = 'block';
            }

            // Function to show JSON input
            function showJsonInput() {
                hideAllInputs();
                jsonInput.style.display = 'block';
            }

            // Function to hide all input sections
            function hideAllInputs() {
                numberInput.style.display = 'none';
                stringInput.style.display = 'none';
                jsonInput.style.display = 'none';
                booleanInput.style.display = 'none';
            }

            // Handle Value Type change
            valueTypeSelect.addEventListener('change', function () {
                if (valueTypeSelect.value === 'number') {
                    showNumberInput();
                } else if (valueTypeSelect.value === 'string') {
                    showStringInput();
                } else if (valueTypeSelect.value === 'json') {
                    showJsonInput();
                } else if (valueTypeSelect.value === 'boolean') {
                    showBooleanInput();
                }
            });

            // JSON validation
            jsonValueInput.addEventListener('input', function () {
                try {
                    JSON.parse(jsonValueInput.value);
                    jsonError.textContent = ''; // Clear error message
                } catch (error) {
                    jsonError.textContent = 'Please enter a valid JSON input.';
                }
            });
            booleanValueInput.addEventListener('input', function () {
                const inputValue = booleanValueInput.value.trim(); // Trim any leading/trailing spaces

                if (inputValue === "0" || inputValue === "1") {
                    booleanError.textContent = ''; // Clear error message
                } else {
                    booleanError.textContent = 'Please enter a valid boolean value (0 or 1).';
                }
            });

            // Handle form submission
            updateSettingButton.addEventListener('click', function () {
                // Clear previous error messages
                settingsKeyError.textContent = '';
                settingsValueError.textContent = '';
                jsonError.textContent = '';

                if (settings_key.value === '') {
                    console.log('here');
                    settingsKeyError.textContent = 'Please enter a Setting Key'
                    return;
                }

                // Get the selected value_type
                const selectedValueType = valueTypeSelect.value;

                // Get the corresponding input field value based on value_type
                let settingsValue = '';
                if (selectedValueType === 'number') {
                    settingsValue = document.getElementById('number_value').value;
                } else if (selectedValueType === 'string') {
                    settingsValue = document.getElementById('string_value').value;
                } else if (selectedValueType === 'boolean') {
                    settingsValue = document.getElementById('boolean_value').value;
                } else if (selectedValueType === 'json') {
                    settingsValue = jsonValueInput.value;

                    // Validate JSON input
                    try {
                        JSON.parse(settingsValue);
                    } catch (error) {
                        jsonError.textContent = 'Please enter a valid JSON input.';
                        return; // Prevent form submission on invalid JSON
                    }
                }

                // Check if settingsValue is empty
                if (settingsValue.trim() === '') {
                    settingsValueError.textContent = 'Please enter a Setting value';
                } else {
                    // Create a hidden input element with the name "settings_value" and value
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = 'settings_value';
                    hiddenInput.value = settingsValue;

                    // Append the hidden input to the form
                    settingsForm.appendChild(hiddenInput);

                    // Submit the form
                    settingsForm.submit();
                }
            });

        });
    </script>
@endsection
