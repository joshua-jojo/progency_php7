<template lang="">
    <div class="grid grid-cols-4 gap-5 ">
        <card2>
            <div class="flex flex-col justify-center items-center">
                <div class="font-bold text-sm uppercase">Total Perumahan</div>
                <div class="text-2xl font-bold">{{master.total_perumahan}} Unit</div>
            </div>
        </card2>
        <card2>
            <div class="flex flex-col justify-center items-center">
                <div class="font-bold text-sm uppercase">tersedia</div>
                <div class="text-2xl font-bold">{{master.perumahan_tersedia}} Unit</div>
            </div>
        </card2>
        <card2>
            <div class="flex flex-col justify-center items-center">
                <div class="font-bold text-sm uppercase">Terjual</div>
                <div class="text-2xl font-bold">{{master.perumahan_terjual}} Unit</div>
            </div>
        </card2>
        <card2>
            <div class="flex flex-col justify-center items-center">
                <div class="font-bold text-sm uppercase">booking</div>
                <div class="text-2xl font-bold">{{master.perumahan_booking}} Unit</div>
            </div>
        </card2>
        <card2 class="col-span-2">
            <div class="flex flex-col justify-center items-center">
                <div class="font-bold text-sm uppercase">Agen</div>
                <div class="text-2xl font-bold">{{master.agen}} Anggota</div>
            </div>
        </card2>
        <card2 class="col-span-2">
            <div class="flex flex-col justify-center items-center">
                <div class="font-bold text-sm uppercase">Developer</div>
                <div class="text-2xl font-bold">{{master.developer}} Anggota</div>
            </div>
        </card2>
    </div>
</template>
<script>
import Card2 from '../../Components/card/card2.vue';
import MainLayout from '../../Layouts/MainLayout.vue';
export default {
    layout: MainLayout,
    components: {
        Card2,
    },
    props: {
        master: Object
    }
}
</script>
<style lang="">
    
</style>