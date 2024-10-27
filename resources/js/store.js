import { createStore } from 'vuex';

export default createStore({
    state: {
        login: {
            email: '',
            code: '',
        },
        permissions:[],
        clearCheckData: '',
    },
    mutations: {
        SET_CLEAR_CHECK_DATA(state, value) {
            state.clearCheckData = value;
        },
    },
    actions: {
        setClearCheckData({ commit }, value) {
          commit('SET_CLEAR_CHECK_DATA', value);
        },
    },
    getters: {}
});