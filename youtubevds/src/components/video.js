import React, {Component} from 'react';

class Video extends Component {
  shouldComponentUpdate(nextProps) {
    return this.props.id !== nextProps.id;
  }

  render() {
    return (
      <div className="column small-12 medium-6 home--youtube-video">
        <iframe style={{width: '100%'}} src={`https://www.youtube.com/embed/${this.props.id}`} frameBorder={0} allowFullScreen={true} ></iframe>
      </div>
    );
  }
}

export default Video;
