<div class="from-block js-date-form">
    <div class="from-block__wrap">
        <h1 class="page-title page-title--mid">Od:</h1>
        <form action="<?= $_SERVER['REQUEST_URI']; ?>" class="js-from-block-form from-block__form">
            <div class="from-block__form-input from-block__form-input--small">
                <label class="from-block__form-input-label" for="name-from-block-1">Dan <span class="required">*</span></label>
                <input type="text" class="js-day-from" id="name-from-block-1"  name="day" maxlength="2">
                <span class="js-from-day-error-message"></span>
            </div>
            <div class="from-block__form-input">
                <label class="from-block__form-input-label" for="name-from-block-2">Mesec <span class="required">*</span></label>
                <input type="text" class="js-month-from" id="name-from-block-2"  name="month" maxlength="2">
                <span class="js-from-month-error-message"></span>
            </div>
            <div class="from-block__form-input from-block__form-input--small">
                <label class="from-block__form-input-label" for="name-from-block-3">Godina <span class="required">*</span></label>
                <input type="text" class="js-year-from" id="name-from-block-3" name="year" maxlength="4">
                <span class="js-from-year-error-message"></span>
            </div>
        </form>
    </div>
</div><!-- .from-block -->
