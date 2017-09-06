import axios from 'axios';

export const FETCH_PROJECTS = 'FETCH_PROJECTS';
export const FETCH_PROJECT = 'FETCH_PROJECT';

const ROOT_URL = `${wpglobals.restURL}wp/v2`;

export function fetchProjects() {
    const request = axios.get(`${ROOT_URL}/projects?&_embed=true`);
    
    return {
        type: FETCH_PROJECTS,
        payload: request
    };
}

export function fetchProject(id) {
    const request = axios.get(`${ROOT_URL}/projects/${id}?&_embed=true`);
    
    return {
        type: FETCH_PROJECT,
        payload: request
    };
}