const state = {
    content: '',
    alert_type: ''
}

const mutations = {
    setContent(state, { content, timeout, alert_type }) {
        state.content = content
        state.alert_type = alert_type

        if (typeof timeout === 'undefined') {
            timeout = 3000
        }

        setTimeout(() => (state.content = ''), timeout)
    },
    removeContent(state) {
        state.content = ''
    }
}

export default {
    namespaced: true,
    state,
    mutations
}