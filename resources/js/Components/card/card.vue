<template lang="">
    <div class="w-full h-full bg-base-100 flex flex-col p-4 mb-2 shadow-lg rounded-2xl">
        <div class="text-xl font-bold drop-shadow-lg mb-2">
            {{title}}
        </div>
        <slot></slot>
        <div class="mt-4 flex justify-end gap-2" v-if="action">
            <slot name="action"></slot>
        </div>
    </div>
</template>
<script>
export default {
    props: {
        title: String,
        action: Boolean
    }
}
</script>
<style lang="">
    
</style>