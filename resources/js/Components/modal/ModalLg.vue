<template lang="">
    <teleport to='body'>
        <input type="checkbox" :id="id" class="modal-toggle" />
        <div class="modal">
            <div class="modal-box w-11/12 max-w-5xl">
                <h3 class="font-bold text-lg">{{title}}</h3>
                <div class="py-4 flex flex-col w-full">
                    <slot></slot>
                </div>
                <div class="modal-action">
                    <slot name="action"></slot>
                    <label v-if="close" :for="id" class="btn">close</label>
                </div>
            </div>
        </div>
    </teleport>
</template>
<script>
export default {
    props: {
        id: String,
        title: String,
        close: Boolean,
    }
}
</script>
<style lang="">
    
</style>