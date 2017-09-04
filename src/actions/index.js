import axios from 'axios';

export const FETCH_PROJECTS = 'FETCH_PROJECTS';

const ROOT_URL = `${wpglobals.restURL}wp/v2`;

export function fetchProjects() {
    const request = axios.get(`${ROOT_URL}/projects`);
    
    return {
        type: FETCH_PROJECTS,
        payload: request
    };
}