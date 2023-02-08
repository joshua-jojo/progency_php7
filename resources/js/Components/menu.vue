<template lang="">
    <Link :href="route('pendataan.perumahan.show',{perumahan : auth.user.developer.id})" v-if="role.developer">
        <li><a :class="{active:$page.component == 'pendataan/perumahan'}">Pendataan Perumahan</a></li>
    </Link>
    <Link :href="route('daftar.perumahan.index')" v-if=" role.agen">
        <li><a :class="{active:$page.component == 'data_perumahan/data_perumahan'}">Data Perumahan </a></li>
    </Link>
    <Link :href="route('menu.data.agen.booking.index')" v-if="role.agen">
        <li><a :class="{active:$page.component == 'menu/agen/data_booking'}">Data Booking</a></li>
    </Link>
    <Link :href="route('menu.data.developer.booking.index')" v-if="role.developer">
        <li><a :class="{active:$page.component == 'menu/developer/data_booking'}">Data Booking</a></li>
    </Link>
    <Link :href="route('menu.data.superadmin.booking.index')" v-if="role.super_admin">
        <li><a :class="{active:$page.component == 'menu/super_admin/booking'}">Data Booking</a></li>
    </Link>
    <Link :href="route('menu.data.superadmin.perumahan.index')" v-if="role.super_admin">
        <li><a :class="{active:$page.component == 'menu/super_admin/data_perumahan'}">Data Perumahan</a></li>
    </Link>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components: {
        Link
    },
    props: {
        role: Object,
        auth: Object,
    }
}
</script>
<style lang="">
    
</style>