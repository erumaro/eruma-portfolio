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
                <article key={project.id} className="single-project">
                    <header>
                        <h1>{project.title.rendered}</h1>
                    </header>
                    <div className='post-content'>
                        <div className="featured-image-wrapper">
                            <img className="featured-image" src={project._embedded["wp:featuredmedia"][0].source_url}/>
                        </div>
                        <div className='post-description' dangerouslySetInnerHTML={ { __html: project.acf.project_description } } />
                        <div className='post-image-wrapper'>
                           <div className='post-image desktop-image'><img src={project.acf.desktop_image.url} alt={project.acf.desktop_image.alt}/></div>
                            <div className='post-image tablet-image'><img src={project.acf.tablet_image.url} alt={project.acf.tablet_image.alt}/></div>
                            <div className='post-image mobile-image'><img src={project.acf.mobile_image.url} alt={project.acf.mobile_image.alt}/></div>
                        </div>
                    </div>
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