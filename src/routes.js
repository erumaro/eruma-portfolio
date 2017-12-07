import React from 'react';
import { Route, IndexRoute } from 'react-router';

import App from './components/app';
import ProjectsIndex from './components/projects_index';
import ProjectsSingle from './components/projects_single';
import TechnologyIndex from './components/technology_index';

export default (
    <Route path="/" component={App}>
        <IndexRoute component={ProjectsIndex} />
        <Route path="projects/:id" component={ProjectsSingle} />
        <Route path="technologies/:id" component={TechnologyIndex} />
    </Route>
);