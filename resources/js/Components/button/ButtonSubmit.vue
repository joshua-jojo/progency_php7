<template lang="">
    <button class="btn" :class="{'w-full' : full,'btn-success' : type == 'success','btn-error' : type == 'error','btn-warning' : type == 'warning', 'btn-disabled loading' : form.processing}"><slot></slot></button>
</template>
<script>
export default {
    props: {
        type: String,
        form: Object,
        full: Boolean
    }
}
</script>
<style lang="">
    
</style>