<script setup>
import {PencilIcon} from "@heroicons/vue/solid";

const props = defineProps ({
    card: Object
});

</script>

<template>
    <li>
        <div
            class="group relative bg-white p-3 shadow rounded-md border-b border-gray-300 hover:bg-gray-50">
            <a href="#" class="text-sm">{{ card.title }}</a>
            
        </div>
    </li>
</template>

<style scoped>

.drag > div {
    transform: rotate(5deg);
}
.ghost {
    background: lightgray;
    border-radius: 6px;
}

.ghost > div {
    visibility: hidden;
}

</style>