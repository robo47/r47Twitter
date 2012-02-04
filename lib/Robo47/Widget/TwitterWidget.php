<?php

class Robo47_Widget_TwitterWidget extends WP_Widget {

    function Robo47_Widget_TwitterWidget($id_base = false, $name = 'r47Twitter', $widget_additional_options = array(), $control_options = array()) {
        // Instantiate the parent object
        $control_options = array_merge($control_options, $this->widget_additional_options());
        parent::__construct($id_base, $name, $widget_additional_options, $control_options);
    }

    /**
     *
     * @param type $args
     * @param type $instance
     */
    function widget($args, $instance) {
        if (isset($instance['title'], $instance['username'], $instance['count'], $instance['cachetime'])) {
        $this->render($instance['title'], $instance['username'], $instance['count'], $instance['cachetime']);
        }
    }

    /**
     *
     * @return array
     */
    public function widget_additional_options() {
        return array('title' => 'Title', 'username' => 'Username', 'count' => 'Number of Tweets (max 20)', 'cachetime' => 'Cachetime');
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        foreach ($this->widget_additional_options() as $option => $description) {
            $instance[$option] = strip_tags($new_instance[$option]);
        }
        return $instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        foreach ($this->widget_additional_options() as $option => $description) {
            $value = '';
            if (isset($instance[$option])) {
                $value = $instance[$option];
            }
            $fieldid = $this->get_field_id($option);
            $fieldname = $this->get_field_name($option);
            $label = _e($option);
            echo <<<EOT
<p>
    <label for="{$fieldid}">{$label}</label>
    <input class="widefat" id="{$fieldid}" name="{$fieldname}" type="text" value="{$value}" />
</p>
EOT;
        }
    }

    /**
     * @param string $username
     * @param integer $count [currently unused]
     * @param integer $cachetime
     * @return string 
     */
    public function fetchTwitterData($username, $count, $cachetime) {
        try {
            $tweets = get_transient(R47TWITTER_TRANSIENT_PREFIX . $username . '_' . $cachetime);
            if (!$tweets) {
                $twitter = new Robo47_Wordpress_Twitter($username);
                $tweets = $twitter->fetchTweets();
                set_transient(R47TWITTER_TRANSIENT_PREFIX . $username . '_' . $cachetime, $tweets, $cachetime);
            }
        } catch (Exception $e) {
            // ignore anything - just return empty string - we are doing frontend stuff! :)
            return '';
        }
        return $tweets;
    }

    /**
     *
     * @param string $title
     * @param string $username
     * @param integer $count
     * @param integer $cachetime 
     */
    public function render($title, $username, $count, $cachetime) {
        echo '<!-- r47Twitter | ' . $count . ' tweets for ' . $username . ' cachetime: ' . $cachetime . ' -->';
        $tweets = $this->fetchTwitterData($username, $count, $cachetime);

        if ($tweets) {
            echo '<div class="rfourseven-tweets">';
            echo '<h3 class="widget-title">' . $title . '</h3>';
            $i = 1;
            foreach ($tweets as $tweet) {

                echo $tweet['text'];
                echo '<a href="https://twitter.com/#!/' . $username . '/status/' . $tweet['id'] . '"><br />';
                echo date('d.m.y H:i:s', strtotime($tweet['created_at']));
                echo '</a>';
                if ($i >= $count) {
                    break;
                } else {
                    echo '<hr />';
                }
                $i++;
            }
            echo '</div>';
        }
        echo '<!-- /r47Twitter -->';
    }

}