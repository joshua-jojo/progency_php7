<template lang="">
    <div class="flex flex-col gap-2">
        <alert type="info-light" v-if="auth.user.agen.agen_file.length < 1" title="Data Profile kamu belum lengkap!" subtitle="Lengkapi data profile untuk segera diproses admin">
            <template v-slot:action>
                <Link :href="route('pengaturan.agen.show',{agen : auth.user.id})" class="btn btn-primary btn-sm">Lihat</Link>
            </template>
        </alert>
        <div class="grid lg:grid-cols-4 gap-2" v-if="auth.user.agen.status_terverifikasi == 'aktif'">
            <card2>
                <div class="flex flex-col justify-center items-center">
                    <div class="font-bold text-sm uppercase">terjual</div>
                    <div class="text-2xl font-bold">{{booking_terjual}} Unit</div>
                </div>
            </card2>
            <card2>
                <div class="flex flex-col justify-center items-center">
                    <div class="font-bold text-sm uppercase">terjual bulan ini</div>
                    <div class="text-2xl font-bold">{{booking_terjual_bulanIni}} Unit</div>
                </div>
            </card2>
            <card2>
                <div class="flex flex-col justify-center items-center">
                    <div class="font-bold text-sm uppercase">Booking</div>
                    <div class="text-2xl font-bold">{{booking}} Unit</div>
                </div>
            </card2>
            <card2>
                <div class="flex flex-col justify-center items-center">
                    <div class="font-bold text-sm uppercase">Grade</div>
                    <div class="text-2xl font-bold uppercase">{{auth.user.agen.rating}}</div>
                </div>
            </card2>
        </div>
    </div>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
import MainLayout from '../../Layouts/MainLayout.vue';
import Alert from '../../Components/alert/Alert.vue'
import Card2 from '../../Components/card/card2.vue';
export default {
    layout: MainLayout,
    components: {
        Alert,
        Link,
        Card2,
    },
    props: ['booking', 'booking_terjual', 'booking_terjual_bulanIni', 'auth', 'agen']
}
</script>
<style lang="">
    
</style>