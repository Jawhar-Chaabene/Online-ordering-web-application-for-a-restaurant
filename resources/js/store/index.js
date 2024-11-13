import { createStore } from 'vuex';
import Articlestore from './modules/articlefeature';
import createPersistedState from 'vuex-persistedstate';

export default createStore({
  modules: {
    Articlestore,
  },
  plugins: [createPersistedState()],
});
