<template lang="">
    <div class="grid lg:grid-cols-12 w-full h-full gap-2">
        <div class="lg:col-span-4">
            <section-1
                class="h-max"
                :foto_profil="foto_profil"
                :dataAgen="agen"
                :key="agen"
            ></section-1>
        </div>
        <div class="lg:col-span-8 flex flex-col h-max">
            <section-2 class="h-max" :dataAgen="agen"></section-2>
            <section-3 :dataAgen="agen" v-if="auth.user.role == 'agen'"> </section-3>
            <section-4 :dataAgen="agen" v-else-if="auth.user.role == 'super admin' || auth.user.role == 'admin'"></section-4>
        </div>
    </div>
</template>
<script>
import MainLayout from "../../../Layouts/MainLayout.vue";
import Section1 from "./section1.vue";
import Section2 from "./section2.vue";
import Section3 from "./section3.vue";
import Section4 from "./section4.vue";

export default {
    layout: MainLayout,
    components: {
        Section1,
        Section2,
        Section3,
        Section4,
    },
    props: {
        agen: Object,
        auth: Object,
        foto_profil: String,
    },
};
</script>
<style lang=""></style>
