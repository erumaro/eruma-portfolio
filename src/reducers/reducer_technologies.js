import { FETCH_TECHNOLOGIES, FETCH_TECHNOLOGY } from '../actions/index';

const INITIAL_STATE = { all: [], technology: null };

export default function(state = INITIAL_STATE, action) {
    switch(action.type) {
        case FETCH_TECHNOLOGY:
            return { ...state, technology: action.payload.data };
        case FETCH_TECHNOLOGIES:
            return { ...state, all: action.payload.data };
        default:
            return state;
    }
}