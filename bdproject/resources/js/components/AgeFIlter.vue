<template>
    <div class="age-tabs d-flex justify-content-center gap-4 mb-4">
        <button
            v-for="option in options"
            :key="option.value"
            @click="selectCategory(option.value)"
            :class="['age-tab', { active: age_category === option.value }]"
        >
            {{ option.label }}
        </button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            age_category: '',
            options: [
                { label: 'Toate', value: '' },
                { label: 'Pui', value: 'Pui' },
                { label: 'Tineri', value: 'Tânăr' },
                { label: 'Adulți', value: 'Adult' },
                { label: 'Seniori', value: 'Senior' },
            ],
        };
    },
    mounted() {
        const query = new URLSearchParams(window.location.search);
        this.age_category = query.get('age_category') || '';
    },
    methods: {
        selectCategory(value) {
            this.age_category = value;
            const query = new URLSearchParams(window.location.search);
            query.set('age_category', value);
            window.location.href = window.location.pathname + '?' + query.toString();
        },
    },
};
</script>

<style scoped>
.age-tab {
    background: none;
    border: none;
    font-size: 1.3rem;
    font-weight: bold;
    color: #d7a74f;
    cursor: pointer;
    transition: color 0.3s ease;
    padding-bottom: 5px;
    position: relative;
}

.age-tab.active {
    color: #2e3c2e;
}

.age-tab.active::after {
    content: '';
    display: block;
    height: 3px;
    width: 100%;
    background-color: #e6d9b5;
    border-radius: 2px;
    margin-top: 6px;
    position: absolute;
    bottom: -6px;
    left: 0;
}
</style>
