import React, {Component} from 'react';
import Axios from 'axios';
import Video from './video.js';

class Videos extends Component {
  constructor(...props) {
    super(...props);

    this.getLatestVideos = this.getLatestVideos.bind(this);

    this.state = {
      videosIds: [],
      intervalId: null,
    };
  }

  componentDidMount() {
		this.getLatestVideos();
    const intervalId = window.setInterval(this.getLatestVideos, 1000 * 60 * 5);
    this.setState({
      intervalId,
    });
  }

  componentWillUnmount(){
    window.clearInterval(this.state.intervalId);
  }

  getLatestVideos() {
		const url = `/accropolis/wp-json/getlatestvids/v1/getlatestvids`
    const _this = this;
    Axios.get(url).then(function(result) {
      _this.setState ({
        videosIds: result.data.items.map(item => item.id.videoId),
      });
    });
  }

  render() {
    if(this.state.videosIds.length === 0) {
      return <h2 className="LoadingTitle">Loading...</h2>;
    } else {
      return (
        <div style={{padding: 0, margin: 0}}>
          {this.state.videosIds.map(videoId => <Video key={videoId} id={videoId}/>)}
        </div>
      );
    }
  }
}

export default Videos;
