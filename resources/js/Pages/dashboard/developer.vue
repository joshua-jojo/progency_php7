<template lang="">
    {{}}
    <div class="grid lg:grid-cols-4 gap-2">
        <Card-2>
            <div class="flex items-center flex-col">
                <div class="text-lg">Total Perumahan</div>
                <div class="text-2xl font-bold">{{master.total_perumahan}}</div>
            </div>
        </Card-2>
        <Card-2>
            <div class="flex items-center flex-col">
                <div class="text-lg">Perumahan Tersedia</div>
                <div class="text-2xl font-bold">{{master.perumahan_tersedia}}</div>
            </div>
        </Card-2>
        <Card-2>
            <div class="flex items-center flex-col">
                <div class="text-lg">Perumahan Terjual</div>
                <div class="text-2xl font-bold">{{master.perumahan_terjual}}</div>
            </div>
        </Card-2>
        <Card-2>
            <div class="flex items-center flex-col">
                <div class="text-lg">Booking</div>
                <div class="text-2xl font-bold">{{master.perumahan_booking}}</div>
            </div>
        </Card-2>
    </div>
</template>
<script>
import Card2 from '../../Components/card/card2.vue';
import MainLayout from '../../Layouts/MainLayout.vue';
export default {
    layout: MainLayout,
    components: {
        Card2
    },
    props: {
        master: Object
    }
}
</script>
<style lang="">
    
</style>