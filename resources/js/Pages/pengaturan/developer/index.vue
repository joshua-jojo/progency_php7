<template lang="">
    <div class="grid lg:grid-cols-12 gap-2">
                <section-1 :developer="developer" :foto_profil="foto_profil" class="h-max lg:col-span-4"></section-1>
            <div class="lg:col-span-8 gap-2 h-max">
                <section-2 :developer="developer" :auth="auth" :provinsi="provinsi"></section-2>
                <Suspense>
                    <section-3 :provinsi="provinsi" :developer="developer"></section-3>
                    <template #fallback>
                            loading....
                    </template>
                </Suspense>
                <!-- <section-4 :developer="developer" :key="developer" title="Dokumen Kelengkapan"></section-4> -->
            </div>
    </div>
</template>
<script>
import MainLayout from '../../../Layouts/MainLayout.vue';
import Card from '../../../Components/card/card.vue'
import section1 from '../../../Pages/pengaturan/developer/section1.vue';
import section2 from '../../../Pages/pengaturan/developer/section2.vue';
import section3 from '../../../Pages/pengaturan/developer/section3.vue';
import section4 from '../../../Pages/pengaturan/developer/section4.vue';
export default {
    layout: MainLayout,
    components: {
        Card,
        section1,
        section2,
        section3,
        section4,
    },
    props: {
        provinsi: Array,
        developer: Object,
        foto_profil: String,
        auth: String,
    }
}
</script>
<style lang="">
    
</style>