<template lang="">
    <Link :href="route('pengaturan.user.index')" v-if="$page.props.auth.user.role == 'admin' || $page.props.auth.user.role == 'super admin'">
        <li><a :class="{active:$page.component == 'pengaturan/user/index'}">Users</a></li>
    </Link>
    <Link :href="route('pengaturan.agen.show',{
        agen : $page.props.auth.user.id
    })" v-if="$page.props.auth.user.role =='agen'">
        <li><a :class="{active:$page.component == 'pengaturan/agen/index'}">Agen</a></li>
    </Link>
    <Link :href="route('pengaturan.developer.show',{
        developer : $page.props.auth.user.id
    })" v-if="$page.props.auth.user.role =='developer'">
        <li><a :class="{active:$page.component == 'pengaturan/agen/index'}">Developer</a></li>
    </Link>
</template>
<script>
import { Link } from '@inertiajs/inertia-vue3';
export default {
    components: {
        Link
    },
}
</script>
<style lang="">
    
</style>