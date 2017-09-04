import React, { Component } from 'react';
import { connect } from 'react-redux';
import { fetchProjects } from '../actions/index';
import { Link } from 'react-router';

class ProjectsIndex extends Component {
    componentWillMount() {
        this.props.fetchProjects();
    }
    
    renderProjects() {
        return this.props.projects.map((project) => {
           return (
            <li key={project.id}>
                <Link to={"projects/" + project.id}>{project.title.rendered}</Link>
            </li>
           );
        });
    }
    
    render() {
        return(
            <div>
                <h3>Projects</h3>
                <ul>
                     {this.renderProjects()}
                </ul>
            </div>
        );
    }
}

function mapStateToProps(state){
    return { projects: state.projects.all };
}

export default connect(mapStateToProps, { fetchProjects })(ProjectsIndex);