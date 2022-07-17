<div class="to-block js-date-form">
    <div class="to-block__wrap">
        <h1 class="page-title page-title--mid">Do:</h1>
        <form action="<?= $_SERVER['REQUEST_URI']; ?>" class="js-to-block-form to-block__form">
            <div class="to-block__form-input to-block__form-input--small">
                <label class="to-block__form-input-label" for="name-to-block-1">Dan <span class="required">*</span></label>
                <input type="text" class="js-day-to" id="name-to-block-1"  name="day" maxlength="2">
                <span class="js-to-day-error-message"></span>
            </div>
            <div class="to-block__form-input">
                <label class="to-block__form-input-label" for="name-to-block-2">Mesec <span class="required">*</span></label>
                <input type="text" class="js-month-to" id="name-to-block-2"  name="month" maxlength="2">
                <span class="js-to-month-error-message"></span>
            </div>
            <div class="to-block__form-input to-block__form-input--small">
                <label class="to-block__form-input-label" for="name-to-block-3">Godina <span class="required">*</span></label>
                <input type="text" class="js-year-to" id="name-to-block-3" name="year" maxlength="4">
                <span class="js-to-year-error-message"></span>
            </div>
        </form>
    </div>
</div><!-- .to-block -->
<button class="btn js-provera">Provera</button>
<span class="js-provera-error-message"></span>


