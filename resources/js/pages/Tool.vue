<template>
    <div class="nova-laracache">
        <div :class="{ dark }">
            <Head :title="__('nova-laracache.section-name')"/>
            <Heading class="mb-6">{{ __('nova-laracache.section-name') }}</Heading>


            <Stats />
            <ModelsList class="mt-8" />
        </div>
    </div>
</template>

<script setup>
import Stats from '../components/Stats.vue'
import ModelsList from '../components/Models/ModelsList.vue'
</script>
