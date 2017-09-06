import React, { Component } from 'react';
import { connect } from 'react-redux';
import { fetchProject } from '../actions/index';
import { Link } from 'react-router';

class ProjectsSingle extends Component {
    componentWillMount() {
        this.props.fetchProject(this.props.params.id);
    }
    
    render() {
        const { project } = this.props;
        
        if( !project ) {
            return <div>Loading...</div>;
        }
        
        return(
            <div id="primary" className="content-area">
               <article key={project.id} className="project">
                   <header>
                       <h1>{project.title.rendered}</h1>
                   </header>
                   <div className='post-content' dangerouslySetInnerHTML={ { __html: project.content.rendered } }></div>
                   <footer></footer>
               </article>
            </div>
        );
    }
}

function mapStateToProps(state) {
    return { project: state.projects.project };
}

export default connect(mapStateToProps, { fetchProject })(ProjectsSingle);