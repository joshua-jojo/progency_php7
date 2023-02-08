<template lang="">
    <div class="grid lg:grid-cols-2 gap-2 w-full ">
                <Card2 class="h-[19rem] lg:h-[29rem] overflow-y-hidden w-full select-none">
                    <swiper
                    :navigation="true"
                    :grabCursor="true"

                    :effect="'creative'"
                    :creativeEffect="{
                        prev: {
                            shadow: true,
                            translate: [0, 0, -400],
                        },
                        next: {
                            translate: ['100%', 0, 0],
                        },
                    }"
                    @swiper="onSwiper"
                    class="w-full h-full"
                    :modules="modules"
                    @slideChange="onSlideChange"
                    >
                        <swiper-slide >
                            <div class="h-[14rem] lg:h-[25rem] w-full ">
                                <img class="rounded-2xl object-cover w-full h-full" :src="perumahan.cover" alt="">
                            </div>
                        </swiper-slide>
                        <swiper-slide v-for="item in perumahan.perumahan_detail.foto">
                            <div class="h-[14rem] lg:h-[25rem] w-full ">
                                <img class="rounded-2xl object-cover w-full h-full" :src="item.file" alt="">
                            </div>
                        </swiper-slide>
                    </swiper>
                </Card2>
        <div class="grid gap-2 pb-5">
            <Card2 class="" v-if="perumahan.status == 'sold'">
                <div class="text-center font-bold text-xl">Telah Terjual</div>
            </Card2>
            <Card2 class="" v-else-if="perumahan.booking">
                <div class="text-center font-bold text-xl">Telah Di Booking</div>
            </Card2>
            <Card2 :title="perumahan.nama">
                <div class="grid grid-cols-2 gap-5">
                    <div class="form-control">
                        <label class="label-text">Nama</label>
                        <label class="">{{perumahan.nama}}</label>
                    </div>
                    <div class="form-control">
                        <label class=" label-text">Tipe</label>
                        <label class="">{{perumahan.tipe}}</label>
                    </div>
                    <div class="form-control">
                        <label class=" label-text">Blok</label>
                        <label class="">{{perumahan.blok}}</label>
                    </div>
                    <div class="form-control">
                        <label class=" label-text">Alamat Lengkap</label>
                        <label class="">{{perumahan.alamat}}</label>
                    </div>
                    <div class="form-control">
                        <label class=" label-text">Jenis</label>
                        <label class="">{{perumahan.jenis}}</label>
                    </div>
                    <div class="form-control">
                        <label class=" label-text">Kondisi</label>
                        <label class="">{{perumahan.kondisi}}</label>
                    </div>
                    <div class="form-control">
                        <label class=" label-text">Sertifikat</label>
                        <label class="">{{perumahan.sertifikat}}</label>
                    </div>
                    <div class="form-control">
                        <label class=" label-text">Harga</label>
                        <label class="">{{rupiah(perumahan.harga)}}</label>
                    </div>
                    <div class="form-control col-span-2">
                        <label class=" label-text mb-2">Keterangan Tambahan</label>
                        <label class="">{{perumahan.deskripsi}}</label>
                    </div>
                </div>
            </Card2>
            <Card2 title="Detail Perumahan">
                <div class="grid grid-cols-2 gap-5">
                    <div class="form-control">
                        <label class="label-text">Cluster</label>
                        <label class="">{{perumahan.perumahan_detail.cluster}}</label>
                    </div>
                    <div class="form-control">
                        <label class="label-text">Kamar Tidur</label>
                        <label class="">{{perumahan.perumahan_detail.kamar_tidur}}</label>
                    </div>
                    <div class="form-control">
                        <label class="label-text">Kamar Mandi</label>
                        <label class="">{{perumahan.perumahan_detail.kamar_mandi}}</label>
                    </div>
                    <div class="form-control">
                        <label class="label-text">Lantai</label>
                        <label class="">{{perumahan.perumahan_detail.lantai}}</label>
                    </div>
                    <div class="form-control">
                        <label class="label-text">Garasi</label>
                        <label class="">{{perumahan.perumahan_detail.garasi}}</label>
                    </div>
                    <div class="form-control">
                        <label class="label-text">Daya Listrik</label>
                        <label class="">{{perumahan.perumahan_detail.daya_listrik}}</label>
                    </div>
                    <div class="form-control">
                        <label class="label-text">Tahun Dibangun</label>
                        <label class="">{{perumahan.perumahan_detail.tahun_dibangun}}</label>
                    </div>
                    <div class="form-control">
                        <label class="label-text">Kondisi Parabotan</label>
                        <label class="">{{perumahan.perumahan_detail.kondisi_parabotan}}</label>
                    </div>
                    <div class="form-control col-span-2">
                        <label class="label-text">Fasilitas Tambahan</label>
                        <label class="">{{perumahan.perumahan_detail.fasilitas}}</label>
                    </div>
                </div>
            </Card2>
            <label for="booking" class="btn btn-primary w-full" v-if="auth.user.role == 'agen'" :class="{'btn-disabled' : perumahan.booking}">booking</label>
            <modal-responsive id="booking" close="true" title="Isi Data Booking">
                <input-text title="nama" v-model:inputValue="form.nama" :error="form.errors.nama"></input-text>
                <input-text title="kontak" v-model:inputValue="form.kontak" :error="form.errors.kontak"></input-text>
                <input-text title="keterangan" v-model:inputValue="form.keterangan" :error="form.errors.keterangan"></input-text>
                <template v-slot:action>
                    <button-submit :form="form" type="success" @click="submit">Booking</button-submit>
                </template>
            </modal-responsive>
        </div>
    </div>
</template>
<script>
import Card2 from '../../Components/card/card2.vue';
import MainLayout from '../../Layouts/MainLayout.vue';
import ButtonSubmit from '../../Components/button/ButtonSubmit.vue';
import { Swiper, SwiperSlide } from 'swiper/vue';
import 'swiper/css';
import "swiper/css/navigation";
import "swiper/css/effect-creative";
import { Navigation, EffectCreative } from "swiper";
import ModalResponsive from '../../Components/modal/ModalResponsive.vue';
import { useForm } from '@inertiajs/inertia-vue3';
import InputText from '../../Components/input/InputText.vue';

export default {
    layout: MainLayout,
    props: ['perumahan', 'auth'],
    components: {
        Card2,
        Swiper,
        SwiperSlide,
        ModalResponsive,
        InputText,
        ButtonSubmit,
    },
    setup(props) {
        const onSwiper = (swiper) => {
        };
        const onSlideChange = () => {
        };

        const break_point = {
            100: { slidesPerView: 2, spaceBetween: 10 },
            320: { slidesPerView: 2, spaceBetween: 10 },
            480: { slidesPerView: 2, spaceBetween: 10 },
            768: { slidesPerView: 2, spaceBetween: 10 },
            1024: { slidesPerView: 2, spaceBetween: 10 },
        }

        const form = useForm({
            perumahan_id: props.perumahan.id,
            nama: null,
            kontak: null,
            keterangan: null,
        })
        return {
            form,
            onSwiper,
            onSlideChange,
            break_point,
            modules: [Navigation, EffectCreative],
        };
    },
    methods: {
        submit() {
            this.form.post(route('menu.booking.perumahan.store'), {
                onSuccess: () => {
                    this.form.reset()
                    document.getElementById('booking').click()
                }
            })
        }
    }
}
</script>
<style lang="">
    
</style>