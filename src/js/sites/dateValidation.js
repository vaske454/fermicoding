const $ = jQuery.noConflict();

'use strict'
const DateValidation = {

    // properties
    $domFromBlockForm: null,
    $domToBlockForm: null,
    $domDayFrom: $('.js-day-from'),
    $domMonthFrom: $('.js-month-from'),
    $domYearFrom: $('.js-year-from'),
    $domDayTo: $('.js-day-to'),
    $domMonthTo: $('.js-month-to'),
    $domYearTo: $('.js-year-to'),
    $domFromDayErrorMessage: $('.js-from-day-error-message'),
    $domToDayErrorMessage: $('.js-to-day-error-message'),
    $domFromMonthErrorMessage: $('.js-from-month-error-message'),
    $domToMonthErrorMessage: $('.js-to-month-error-message'),
    $domFromYearErrorMessage: $('.js-from-year-error-message'),
    $domToYearErrorMessage: $('.js-to-year-error-message'),
    $domProvera: $('.js-provera'),
    $domProveraErrorMessage: $('.js-provera-error-message'),

    /**
     * @desc Initialize
     */
    init: function() {
        if ($('.js-date-form').length > 0) {
            DateValidation.$domFromBlockForm = $('.js-from-block-form');
            DateValidation.$domToBlockForm = $('.js-to-block-form');
            this.onChangeFromBlock();
            this.onChangeToBlock();
            this.onClickValidation();
        }
    },

    /**
     * @desc On Change From Block Form
     */
    onChangeFromBlock: function() {
        DateValidation.$domFromBlockForm.find('input').on('input change', function(){
            const fromValidationResult = DateValidation.validationFromForm();
            if (fromValidationResult === true) {
                // do something
            }
        });
    },

    /**
     * @desc On Change To Block Form
     */
    onChangeToBlock: function() {
        DateValidation.$domToBlockForm.find('input').on('input change', function() {
            const toValidationResult = DateValidation.validationToForm();
            if (toValidationResult === true) {
                // do something
            }
        })
    },

    /**
     * @desc From Form Validation
     * @returns {string|boolean}
     */
    validationFromForm: function() {
        //serialize array
        const form = DateValidation.$domFromBlockForm.serializeArray();

        //empty error messages
        DateValidation.$domFromDayErrorMessage.empty();
        DateValidation.$domFromMonthErrorMessage.empty();
        DateValidation.$domFromYearErrorMessage.empty();

        //convert to int
        const day = parseInt(form[0].value.trim());
        const month = parseInt(form[1].value.trim());
        const year = parseInt(form[2].value.trim());

        //convert to array
        let dayArray = Array.from(form[0].value);
        let monthArray = Array.from(form[1].value);
        let yearArray = Array.from(form[2].value);

        // get days in month
        let daysInMonth = new Date(year, month, 0).getDate();

        /**
         * Day field validation
         */
        // if something is not a number
        for (let i = 0; i<dayArray.length; i++) {
            if (!$.isNumeric(dayArray[i])) {
                //add error message
                DateValidation.$domFromDayErrorMessage.text('Molimo vas unesite broj.');
                return 'Molimo vas unesite broj.';
            }
        }

        // if field is empty
        if (form[0].value === '') {
            DateValidation.$domFromDayErrorMessage.text('Ovo polje je obavezno.');
            return 'Ovo polje je obavezno.';
        }

        // if day is less than or equal to zero
        if (day <= 0) {
            DateValidation.$domFromDayErrorMessage.text('Dan ne moze biti manji od 1 dan.');
            return 'Dan ne moze biti manji od 1 dan.';
        }

        // if the day is greater than the day in the selected month
        if (daysInMonth < day) {
            DateValidation.$domFromDayErrorMessage.text('Ovaj mesec nema toliko dana.');
            return 'Ovaj mesec nema toliko dana.';
        }

        /**
         * Month field validation
         */
        // if something is not a number
        for (let i = 0; i<monthArray.length; i++) {
            if (!$.isNumeric(monthArray[i])) {
                DateValidation.$domFromMonthErrorMessage.text('Molimo vas unesite broj.');
                return 'Molimo vas unesite broj.';
            }
        }

        // if field is empty
        if (form[1].value === '') {
            DateValidation.$domFromMonthErrorMessage.text('Ovo polje je obavezno.');
            return 'Ovo polje je obavezno.';
        }

        // if month is greater than the 12 or less than zero
        if (month > 12 || month <= 0) {
            DateValidation.$domFromMonthErrorMessage.text('Mesec ne moze biti duzi od 12 ili manji od 1 mesec.');
            return 'Mesec ne moze biti duzi od 12 ili manji od 1 mesec.';
        }

        /**
         * Year field validation.
         */
        // if something is not a number
        for (let i = 0; i<yearArray.length; i++) {
            if (!$.isNumeric(yearArray[i])) {
                DateValidation.$domFromYearErrorMessage.text('Molimo vas unesite broj.');
                return 'Molimo vas unesite broj.';
            }
        }

        // if field is empty
        if (form[2].value === '') {
            DateValidation.$domFromYearErrorMessage.text('Ovo polje je obavezno.');
            return 'Ovo polje je obavezno.';
        }

        // if year is less than or equal to zero
        if (year <= 0) {
            DateValidation.$domFromYearErrorMessage.text('Godina ne moze biti manja od 1.');
            return 'Godina ne moze biti manja od 1.';
        }

        //empty error messages
        DateValidation.$domFromDayErrorMessage.empty();
        DateValidation.$domFromMonthErrorMessage.empty();
        DateValidation.$domFromYearErrorMessage.empty();


        return true;
    },

    /**
     * @desc To Form Validation
     * @returns {string|boolean}
     */
    validationToForm: function() {
        const form = DateValidation.$domToBlockForm.serializeArray();

        //empty error messages
        DateValidation.$domToDayErrorMessage.empty();
        DateValidation.$domToMonthErrorMessage.empty();
        DateValidation.$domToYearErrorMessage.empty();

        //convert to int
        const day = parseInt(form[0].value.trim());
        const month = parseInt(form[1].value.trim());
        const year = parseInt(form[2].value.trim());

        //convert to array
        let dayArray = Array.from(form[0].value);
        let monthArray = Array.from(form[1].value);
        let yearArray = Array.from(form[2].value);

        // get days in month
        let daysInMonth = new Date(year, month, 0).getDate();


        /**
         * Day field validation
         */
        // if something is not a number
        for (let i = 0; i<dayArray.length; i++) {
            if (!$.isNumeric(dayArray[i])) {
                DateValidation.$domToDayErrorMessage.text('Molimo vas unesite broj.');
                return 'Molimo vas unesite broj.';
            }
        }

        // if field is empty
        if (form[0].value === '') {
            DateValidation.$domToDayErrorMessage.text('Ovo polje je obavezno.');
            return 'Ovo polje je obavezno.';
        }

        // if day is less than or equal to zero
        if (day <= 0) {
            DateValidation.$domToDayErrorMessage.text('Dan ne moze biti manji od 1 dan.');
            return 'Dan ne moze biti manji od 1 dan.';
        }

        // if the day is greater than the day in the selected month
        if (daysInMonth < day) {
            DateValidation.$domToDayErrorMessage.text('Ovaj mesec nema toliko dana.');
            return 'Ovaj mesec nema toliko dana.';
        }

        /**
         * Month field validation
         */
        // if something is not a number
        for (let i = 0; i<monthArray.length; i++) {
            if (!$.isNumeric(monthArray[i])) {
                DateValidation.$domToMonthErrorMessage.text('Molimo vas unesite broj.');
                return 'Molimo vas unesite broj.';
            }
        }

        // if field is empty
        if (form[1].value === '') {
            DateValidation.$domToMonthErrorMessage.text('Ovo polje je obavezno.');
            return 'Ovo polje je obavezno.';
        }

        // if month is greater than the 12 or less than zero
        if (month > 12 || month <= 0) {
            DateValidation.$domToMonthErrorMessage.text('Mesec ne moze biti duzi od 12 ili manji od 1 mesec.');
            return 'Mesec ne moze biti duzi od 12 ili manji od 1 mesec.';
        }

        /**
         * Year field validation
         */
        // if something is not a number
        for (let i = 0; i<yearArray.length; i++) {
            if (!$.isNumeric(yearArray[i])) {
                DateValidation.$domToYearErrorMessage.text('Molimo vas unesite broj.');
                return 'Molimo vas unesite broj.';
            }
        }

        // if field is empty
        if (form[2].value === '') {
            DateValidation.$domToYearErrorMessage.text('Ovo polje je obavezno.');
            return 'Ovo polje je obavezno.';
        }

        // if year is less than or equal to zero
        if (year <= 0) {
            DateValidation.$domToYearErrorMessage.text('Godina ne moze biti manja od 1.');
            return 'Godina ne moze biti manja od 1.';
        }

        //empty error messages
        DateValidation.$domToDayErrorMessage.empty();
        DateValidation.$domToMonthErrorMessage.empty();
        DateValidation.$domToYearErrorMessage.empty();


        return true;
    },

    /**
     * @desc Validate if the To date is less than From Date
     */
    onClickValidation: function() {
        DateValidation.$domProvera.on('click', ()=>{
            DateValidation.$domProveraErrorMessage.empty();
            if (parseInt(DateValidation.$domYearTo.val()) === parseInt(DateValidation.$domYearFrom.val()) && parseInt(DateValidation.$domMonthTo.val()) === parseInt(DateValidation.$domMonthFrom.val()) && parseInt(DateValidation.$domDayTo.val()) < parseInt($('.js-day-from').val())) {
                DateValidation.$domProveraErrorMessage.text('Datum Do mora biti veci (ili jednak) od datume Od.');
                return 'Datum Do mora biti veci (ili jednak) od datume Od.';
            }

            if (parseInt(DateValidation.$domYearTo.val()) === parseInt(DateValidation.$domYearFrom.val()) && parseInt(DateValidation.$domMonthTo.val()) < parseInt(DateValidation.$domMonthFrom.val())) {
                DateValidation.$domProveraErrorMessage.text('Datum Do mora biti veci (ili jednak) od datume Od.');
                return 'Datum Do mora biti veci (ili jednak) od datume Od.';
            }

            if (parseInt(DateValidation.$domYearTo.val()) < parseInt(DateValidation.$domYearFrom.val())) {
                DateValidation.$domProveraErrorMessage.text('Datum Do mora biti veci (ili jednak) od datume Od.');
                return 'Datum Do mora biti veci (ili jednak) od datume Od.';
            }
            DateValidation.$domProveraErrorMessage.empty();
        });
    }
};

// initialise on DOM ready
$(function() {
    DateValidation.init();
});