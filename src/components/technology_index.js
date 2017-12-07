import React, { Component } from 'react';
import { connect } from 'react-redux';
import { fetchTechnology } from '../actions/index';
import { Link } from 'react-router';

class TechnologyIndex extends Component {
    componentWillMount() {
        this.props.fetchTechnology(this.props.params.id);
    }
    
    renderProjects() {
        return this.props.technology.map((technology) => {
           return (
               <article key={technology.id} className="project">
                   <div className="featured-image-wrapper">
                       <img className="featured-image" src={technology._embedded["wp:featuredmedia"][0].source_url}/>
                   </div>
                   <div className="project-content">
                       <h2>{technology.title.rendered}</h2>
                       <div className='project-excerpt' dangerouslySetInnerHTML={ { __html: technology.excerpt.rendered } }></div>
                       <Link to={'projects/' + technology.id} type="button">Read more</Link>
                   </div>
               </article>
           );
        });
    }
    
    render() {
        return(
            <div id="primary" className="content-area">
                <h1>Projects</h1>
                {this.renderProjects()}
            </div>
        );
    }
}

function mapStateToProps(state){
    return { technology: state.technologies.technology };
}

export default connect(mapStateToProps, { fetchTechnology })(TechnologyIndex);