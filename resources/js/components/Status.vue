<template>
    <div class="flex items-center" :class="['status-' + statusSlug, withBackground ? 'with-bg' : '']">
        <Badge class="whitespace-nowrap flex items-center gap-2 mx-auto" :title="status">
            <div>
                <Icon
                    v-if="status === 'NOT_CREATED'"
                    name="minus-circle"
                    type="mini"
                />

                <Loader
                    v-else-if="status === 'CREATING'"
                    width="20"
                />

                <Icon
                    v-if="status === 'DELETED'"
                    name="exclamation-circle"
                    type="mini"
                    style="fill: rgb(239,68,68)"
                />

                <Icon
                    v-if="status === 'CREATED'"
                    name="check-circle"
                    type="mini"
                />
            </div>

            <span class="slug">{{ __(statusSlug) }}</span>
        </Badge>
    </div>
</template>

<script setup>
import {computed} from 'vue'
import {Icon} from 'laravel-nova-ui'


const props = defineProps({
    status: {
        type: String,
        required: true,
        validate: value => ['NOT_CREATED', 'CREATING', 'CREATED', 'DELETED'].includes(value)
    },
    withBackground: {
        type: Boolean,
        default: false
    }
})

const statusSlug = computed(() => {
    return props.status.toLowerCase().replace('_', '-')
})
</script>

<style lang="scss" scoped>
.status-not-created {
    .slug {
        color: rgba(var(--colors-yellow-800));
    }

    svg {
        fill: rgba(var(--colors-yellow-400));
    }

    &.with-bg {
        background-color: rgba(var(--colors-yellow-400));
    }
}

.status-created {
    .slug {
        color: rgba(var(--colors-green-700));
    }

    svg {
        fill: rgba(var(--colors-green-400));
    }

    &.with-bg {
        background-color: rgba(var(--colors-green-400));

    }
}

.status-deleted {
    .slug {
        color: rgba(var(--colors-red-700));
    }

    svg {
        fill: rgba(var(--colors-red-400));
    }

    &.with-bg {
        background-color: rgba(var(--colors-red-400));
    }
}

.with-bg {
    border-radius: 0.25rem;
    min-height: 28px;

    .slug {
        color: white !important;
    }

    svg {
        fill: white !important;
    }
}
</style>
