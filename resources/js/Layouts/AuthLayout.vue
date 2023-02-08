<template lang="">
    <div class="w-screen h-screen bg-gray-600 bg-opacity-30">
        <div class="flex justify-center items-center h-full overflow-auto">
            <transition name="page">
                <div :key="$page.component">
                    <div class="h-max shadow-lg rounded-lg lg:min-w-[29rem] p-8 bg-base-100 ">
                        <slot></slot>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<style>
.page-enter-active {
    animation: flip-scale-up-ver .5s linear both;
    position: absolute;
}

.page-leave-active {
    animation: flip-scale-up-ver .5s linear both reverse;
}

@keyframes flip-scale-up-ver {
    0% {
        opacity: 0%;
        transform: rotateY(0)
    }

    50% {
        opacity: 0%;
        transform: rotateY(90deg)
    }

    100% {
        opacity: 100%;
    }
}

.alert-enter-from,
.alert-leave-to {
    transform: translateX(200%)
}

.alert-leave-from,
.alert-enter-to {
    transform: translateX(0%)
}

.alert-enter-active {
    animation: slide-left 1s cubic-bezier(.175, .885, .32, 1.275) both
}

.alert-leave-active {
    animation: slide-left 1s cubic-bezier(.175, .885, .32, 1.275) both reverse
}

@keyframes slide-left {
    0% {
        transform: translateX(200%)
    }

    100% {
        transform: translateX(0%)
    }
}
</style>