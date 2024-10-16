<!-- resources/views/components/submit-button.blade.php -->
<div class="d-flex align-items-center text-center">
    <button type="submit" class="btn btn-success" id="{{ $buttonId ?? 'submitButton' }}">
        {{ $buttonText ?? 'Kaydet' }}
    </button>
    <div id="loadingMessage{{$buttonId ?? ''}}" class="ms-2" style="display: none; align-items: center;">
        <div class="spinner-border text-success me-2" role="status">
            <span class="sr-only"></span>
        </div>
        {{ $loadingText ?? 'Lütfen Bekleyiniz...' }}
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        let submitButton = document.getElementById('{{ $buttonId ?? 'submitButton' }}');
        let loadingMessage = document.getElementById('{{'loadingMessage'.$buttonId ?? 'loadingMessage' }}');

        submitButton.addEventListener('click', function (event) {
            event.preventDefault(); // Form submit olayını geçici olarak durdur
            // Disable button and show loading message
            submitButton.disabled = true;
            submitButton.style.display = 'none';
            loadingMessage.style.display = 'flex';

            // Formu manuel olarak submit et
            submitButton.closest('form').submit();
        });
    });
</script>
