<template>
    <div>
        <section class="profile-edit">
            <div class="container">
                <div class="profile-edit__content">
                    <div class="row no-gutters">
                        <div class="col-md-12 col-lg-3 col-xl-3">
                            <user-card
                                v-if="user.id"
                                :avatar="user.avatar.original"
                                :name="user.name"
                                :status="user.status_name"
                                :speciality="user.info.speciality"
                                :status-id="user.status"
                            />
                        </div>
                        <div class="col-md-12 col-lg-8 col-xl-8 offset-lg-1 offset-xl-1">
                            <div class="profile-edit__wrapper">
                                <a href="/lk/profile" class="back-btn back-btn-white">
                                    <span class="back-arrow-svg"></span> <span>Назад</span>
                                </a>
                                <div class="profile-edit__title"><span>Спецпредложения</span></div>
                                <form @submit.prevent="createOffer" class="profile-edit__body profile-special__body">
                                    <!-- Line -->
                                    <div class="pe-block">
                                        <div class="pe-block__form form">
                                            <div>
                                                <div class="row">
                                                    <div class="col-12 col-sm-12 col-md-6 col-xl-6">
                                                        <label class="form__label">
                                                            <select-app
                                                                v-if="renderSpecialitySelect"
                                                                :options="services"
                                                                select-value="id"
                                                                select-name="name"
                                                                v-model="selectService"
                                                                description="Выберете услугу"
                                                                empty-selected="Выберете услугу"
                                                            ></select-app>
                                                        </label>
                                                        <label class="form__label">
                                                            <span>Выбериет дату, несколько дат или диапазон дат </span>
                                                            <div class="profile-special__calendar-wrapper">
                                                                <v-calendar
                                                                mode="multiple"
                                                                title-position="left"
                                                                v-model="dates"
                                                                :available-dates='{ start: minDate, end: maxDate }'
                                                                is-inline
                                                                >
                                                                </v-calendar>
                                                            </div>

                                                        </label>
                                                    </div>
                                                    <div class="col-12 col-sm-12 col-md-6 col-xl-6">
                                                        <discount-select v-model="discount" v-if="renderDiscount"></discount-select>
                                                        <label class="form__label">
                                                            <span>Дополнительные условия предложения</span>
                                                            <textarea-app
                                                                v-model="description"
                                                                :limit="500"
                                                            ></textarea-app>
                                                            <div class="profile-special__label-comment">
                                                                <p>
                                                                    Здесь укажите все, что может повлиять на стоимость ваших услуг. Минимальное время
                                                                    или количество. Территориальные предпочтения. И прочее.
                                                                </p>
                                                            </div>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="pe-block__add-btn">
                                        <button type="submit" class="add-btn add-btn-green">

                                            <span>Добавить спецпредложение</span>
                                        </button>
                                    </div>
                                </form>
                                <edit-offer-items
                                    @success-update="successPublishedOffers"
                                    :offers="offers"
                                />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <alert :messages="alertMessages" v-if="isActiveAlert" />
        </section>
    </div>

</template>

<script>
    import axios from '../modules/axios'
    import SelectApp from "../components/SelectApp";
    import DatePicker from 'v-calendar/lib/components/date-picker.umd'
    import DiscountSelect from "../components/DiscountSelect";
    import TextareaApp from "../components/TextareaApp";
    import Alert from "../components/Alert";
    import dayjs from "dayjs";
    import EditOfferItems from "../components/EditOfferItems";
    import UserCard from "../components/Profile/UserCard";

    export default {
        name: "CreateOffer",
        props:['editProfileLink'],
        data() {
            return {
                services:[],
                offers:[],
                discount:0,
                service:0,
                description:null,
                dates:[],
                user:{},
                avatar:{},
                selectService:{},
                minDate:null,
                maxDate:null,
                alertMessages:[],
                isActiveAlert:false,
                renderDiscount:true,
                renderSpecialitySelect:true
            }
        },
        methods: {
            createOffer() {
                let dates = null;
                if (this.dates.length) {
                    dates = this.dates.map(date => {
                        return dayjs(date.toString()).format('YYYY-MM-DD')
                    });
                }

                let payload = {
                    service_id: this.selectService,
                    dates: dates,
                    discount: this.discount,
                    description: this.description,
                };

                axios.post('/app/offers', payload)
                    .then(({data}) => {
                        //location.href = data.data.url;
                        axios.get('/app/offers')
                            .then(({data}) => {
                                let offers = data.offers;
                                this.offers = offers;
                            });

                        this.triggerAlert([{
                            type:'success',
                            body:'Ваше предложение успешно добавлено'
                        }]);

                        this.discount = 0;
                        this.selectService = null;
                        this.dates = [];
                        this.description = null;

                        this.renderDiscount = false;
                        this.renderSpecialitySelect = false;

                        setTimeout(() => {
                            this.renderSpecialitySelect = true;
                            this.renderDiscount = true;
                        }, 0)

                    })
                    .catch(({response}) => {
                        if (response.status === 422) {
                            let errors = response.data.errors;
                            let messages = [];
                            for(let key in errors) {
                                errors[key].map(er => {
                                    messages.push({
                                        type:'error',
                                        body: er
                                    });
                                })
                            }
                            this.triggerAlert(messages);
                        }
                    })
            },
            triggerAlert(messages) {
                this.isActiveAlert = true;
                this.alertMessages = messages;
                setTimeout(() => {
                    this.isActiveAlert = false
                    this.alertMessages = [];
                }, 5000);
            },
            successPublishedOffers() {
                this.triggerAlert([{
                    type:'success',
                    body:'Ваши предложения успешно опубликованы'
                }]);
            }
        },
        mounted() {
            axios.get('/app/offers?status=1')
                .then(({data}) => {
                    let offers = data.offers;
                    this.offers = offers;
                });

            axios.get('/app/users')
                .then(({data}) => {
                    this.user = data.user;
                });

            axios.get('/app/services?status=1')
                    .then(({data}) => {
                        this.services = data.services;
                    })

            axios.get('/app/offers/create')
                .then(res => res.data.data)
                .then(data => {
                    //this.services = data.services;
                    this.minDate = data.minDate;
                    this.maxDate = data.maxDate;
                })
        },
        components: {
            UserCard,
            'v-calendar':DatePicker,
            SelectApp,
            DiscountSelect,
            TextareaApp,
            Alert,
            EditOfferItems
        }
    }
</script>

<style>
    .profile-edit__body.disabled {
        filter: grayscale(100%);
        opacity: .7;
    }
</style>
