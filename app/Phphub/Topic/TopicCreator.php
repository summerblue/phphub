<?php namespace Phphub\Topic;

use Phphub\Forms\TopicCreationForm;
use Phphub\Core\CreatorListener;
use Topic, Auth, Carbon;

class TopicCreator
{
    protected $topicModel;
    protected $form;

    public function __construct(Topic $topicModel, TopicCreationForm $form)
    {
        $this->userModel  = $topicModel;
        $this->form = $form;
    }

    public function create(CreatorListener $observer, $data)
    {
        $data['user_id'] = Auth::user()->id;
        $data['created_at'] = Carbon::now()->toDateTimeString();
        $data['updated_at'] = Carbon::now()->toDateTimeString();

        // Validation
        $this->form->validate($data);

        $topic = Topic::create($data);
        if ( ! $topic) 
        {
            return $observer->creatorFailed($topic->getErrors());
        }

        Auth::user()->topic_count++;
        Auth::user()->save();
        
        return $observer->creatorSucceed($topic);
    }
}