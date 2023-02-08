<template lang="">
    <Card title="Data Perumahan">
        <div class="grid gap-4 w-full">
            <section-1 :perumahan="developer.perumahan" :developer="developer" class=" w-full"></section-1>
        </div>
    </Card>
</template>
<script>
import MainLayout from '../../Layouts/MainLayout.vue';
import Card from '../../Components/card/card.vue';
import Section1 from '../../Pages/pendataan/perumahan/section1.vue'
import Section2 from '../../Pages/pendataan/perumahan/section2.vue'
export default {
    layout: MainLayout,
    components: {
        Card,
        Section1,
        Section2,
    },
    props: {
        auth: Object,
        developer: Object,
    }
}
</script>
<style lang="">
    
</style>