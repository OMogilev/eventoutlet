import Vue from 'vue'
import $ from "jquery";
import '../scripts/header';
import AuthForm from "../app/components/Auth/AuthForm";
import FilterApp from "../app/components/FilterApp";
import FilterSelect from "../app/components/FilterSelect";
import FilterDatePicker from "../app/components/FilterDatePicker";
import FilterRangeSlider from "../app/components/FilterRangeSlider";
import SpecialOfferCheckBox from "../app/components/SpecialOfferCheckBox";
import AdditionField from "../app/components/AdditionField";
import PerPageApp from "../app/components/PerPageApp";
import Feedback from '../app/components/Feedback';
import Oferta from '../app/components/Oferta';
import SpecialitySelect from "../app/components/SpecialitySelect";
import SubscribeModal from "../app/components/SubscribeModel";
import '../common/algo';
import 'simplebar';


$(document).ready(function () {
    $('.catalog-filter__preview').click(function(){
        $('.catalog-filter').toggleClass('show');
    });

    $('#close-mobile-filter').click(function(){
        $('.catalog-filter').removeClass('show');
    });

    $('.form-filter-trigger').click(function () {
        $('#offers-filter').submit()
    })
});

new Vue({
    el:'#app',
    components: {
        AuthForm,
        FilterApp,
        FilterSelect,
        FilterDatePicker,
        FilterRangeSlider,
        SpecialOfferCheckBox,
        AdditionField,
        PerPageApp,
        Feedback,
        Oferta,
        SpecialitySelect,
        SubscribeModal
        //SearchInCategory
    }
});
