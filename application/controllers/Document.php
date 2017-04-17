<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Document class
 *
 * Copyright (c) CIBoard <www.ciboard.co.kr>
 *
 * @author CIBoard (develop@ciboard.co.kr)
 */

/**
 * 일반 문서 페이지를 보여주는 controller 입니다.
 */
class Document extends CB_Controller
{

    /**
     * 모델을 로딩합니다
     */
    protected $models = array('Post', 'Document', 'Post_extra_vars','Board');

    /**
     * 헬퍼를 로딩합니다
     */
    protected $helpers = array('form', 'array');

    function __construct()
    {
        parent::__construct();

        /**
         * 라이브러리를 로딩합니다
         */
        $this->load->library(array('querystring'));
    }


    /**
     * 일반문서를 보여주는 함수입니다
     */
    public function index($doc_key = '',$post_id = 0)
    {   
        // 이벤트 라이브러리를 로딩합니다
        $eventname = 'event_document_index';
        $this->load->event($eventname);

        $view = array();
        $view['view'] = array();

        if (empty($doc_key)) {
            show_404();
        }



        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before'] = Events::trigger('before', $eventname);

        $docinfo = $this->cache->get('document-key-id-info');

        $doc_id = ($docinfo && element($doc_key, $docinfo)) ? element($doc_key, $docinfo) : '';
        if ($doc_id) {
            $data = $this->Document_model->get_one($doc_id);
        } else {
            $where = array(
                'doc_key' => $doc_key,
            );
            $data = $this->Document_model->get_one('', '', $where);
        }
        if ( ! element('doc_id', $data)) {
            show_404();
        }

        if ( ! $this->session->userdata('doc_id_' . element('doc_id', $data))) {
            $this->Document_model->update_hit(element('doc_id', $data));
            $this->session->set_userdata(
                'doc_id_' . element('doc_id', $data),
                '1'
            );
        }

        $data['content'] = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? (element('doc_mobile_content', $data) ? element('doc_mobile_content', $data)
            : element('doc_content', $data)) : element('doc_content', $data);

        $thumb_width = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? $this->cbconfig->item('document_mobile_thumb_width')
            : $this->cbconfig->item('document_thumb_width');

        $autolink = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? $this->cbconfig->item('use_document_mobile_auto_url')
            : $this->cbconfig->item('use_document_auto_url');

        $popup = ($this->cbconfig->get_device_view_type() === 'mobile')
            ? $this->cbconfig->item('document_mobile_content_target_blank')
            : $this->cbconfig->item('document_content_target_blank');

        $data['content'] = display_html_content(
            element('content', $data),
            element('doc_content_html_type', $data),
            $thumb_width,
            $autolink,
            $popup,
            $writer_is_admin = true
        );
        $view['view']['data'] = $data;
        $view['view']['doc_key'] = $doc_key;

        $view['view']['canonical'] = document_url($doc_key);

        $post_id = (int) $post_id;
        if (!empty($post_id) && $post_id > 0) {
            $post = $this->Post_model->get_one($post_id);
            $view['view']['extravars'] = $this->Post_extra_vars_model->get_all_meta($post_id);
            $board = $this->board->item_all(element('brd_id', $post));
            $view['view']['board_key'] = element('brd_key', $board);

            
            
            $where_in=array();
            $where=array();

            if(empty(get_cookie('region')) || get_cookie('region')===0){
            //if(strpos($brd_key,'_0' )!==false){
                $this->load->model('Board_model');

                $brdidwhere = array(
                        'bgr_id' => element('bgr_id', $board),
                    );

                $brdidarr = $this->Board_model
                        ->get('', 'brd_id', $brdidwhere, '', '', 'brd_id', 'ASC');

                foreach ($brdidarr as $value) {
                    $brd_id_arr[] = $value['brd_id'];
                   
                }
                
                $where_in=array(
                    'brd_id' => $brd_id_arr,
                );
            } else {
                $where = array(
                    'brd_id' => $this->board->item_key('brd_id', $brd_key),
                );
            }
            
            if(strpos(element('brd_key', $board),'_review' )!==false){
                $where = array(
                    'post_parent' => $this->input->get('post_parent', null, 0)
                );   
            }

            
            $where['post_del <>'] = 2;
            if (element('except_notice', $board)
                && $this->cbconfig->get_device_view_type() !== 'mobile') {
                $where['post_notice'] = 0;
            }
            if (element('mobile_except_notice', $board)
                && $this->cbconfig->get_device_view_type() === 'mobile') {
                $where['post_notice'] = 0;
            }
            if (element('use_personal', $board) && $is_admin === false) {
                $where['post.mem_id'] = $mem_id;
            }

            $category_id = (int) $this->input->get('category_id');
            if (empty($category_id) OR $category_id < 1) {
                $category_id = '';
            }
            $result = $this->Post_model
                ->get_post_list('', '', $where, '', '', '', '','',$where_in);            

            if (element('list', $result)) {
                foreach (element('list', $result) as $key => $val) {

                   
                    $result['list'][$key]['post_url'] = post_url(element('brd_key', $board), element('post_id', $val));

                    

                    $result['list'][$key]['extravars'] = $this->Post_extra_vars_model->get_all_meta(element('post_id', $val));

                    if ($this->cbconfig->get_device_view_type() === 'mobile') {
                        $result['list'][$key]['title'] = element('mobile_subject_length', $board)
                            ? cut_str(element('post_title', $val), element('mobile_subject_length', $board))
                            : element('post_title', $val);
                    } else {
                        $result['list'][$key]['title'] = element('subject_length', $board)
                            ? cut_str(element('post_title', $val), element('subject_length', $board))
                            : element('post_title', $val);
                    }
                    
                    $result['list'][$key]['is_mobile'] = (element('post_device', $val) === 'mobile') ? true : false;
                }
            }
            $view['view']['all_extravars'] = $result;
            $view['view']['post'] = $post;
            $view['view']['post_url'] = post_url(element('brd_key', $board), $post_id);
        }

        



        // 이벤트가 존재하면 실행합니다
        $view['view']['event']['before_layout'] = Events::trigger('before_layout', $eventname);

        /**
         * 레이아웃을 정의합니다
         */
        $page_title = $this->cbconfig->item('site_meta_title_document');
        $meta_description = $this->cbconfig->item('site_meta_description_document');
        $meta_keywords = $this->cbconfig->item('site_meta_keywords_document');
        $meta_author = $this->cbconfig->item('site_meta_author_document');
        $page_name = $this->cbconfig->item('site_page_name_document');

        $searchconfig = array(
            '{문서제목}',
            '{문서아이디}',
        );
        $replaceconfig = array(
            element('doc_title', $data),
            $doc_key,
        );

        $page_title = str_replace($searchconfig, $replaceconfig, $page_title);
        $meta_description = str_replace($searchconfig, $replaceconfig, $meta_description);
        $meta_keywords = str_replace($searchconfig, $replaceconfig, $meta_keywords);
        $meta_author = str_replace($searchconfig, $replaceconfig, $meta_author);
        $page_name = str_replace($searchconfig, $replaceconfig, $page_name);

        $layout_dir = element('doc_layout', $data) ? element('doc_layout', $data) : $this->cbconfig->item('layout_document');
        $mobile_layout_dir = element('doc_mobile_layout', $data) ? element('doc_mobile_layout', $data) : $this->cbconfig->item('mobile_layout_document');
        $use_sidebar = element('doc_sidebar', $data) ? element('doc_sidebar', $data) : $this->cbconfig->item('sidebar_document');
        $use_mobile_sidebar = element('doc_mobile_sidebar', $data) ? element('doc_mobile_sidebar', $data) : $this->cbconfig->item('mobile_sidebar_document');
        $skin_dir = element('doc_skin', $data) ? element('doc_skin', $data) : $this->cbconfig->item('skin_document');
        $mobile_skin_dir = element('doc_mobile_skin', $data) ? element('doc_mobile_skin', $data) : $this->cbconfig->item('mobile_skin_document');
        $layoutconfig = array(
            'path' => 'document',
            'layout' => 'layout',
            'skin' => 'document',
            'layout_dir' => $layout_dir,
            'mobile_layout_dir' => $mobile_layout_dir,
            'use_sidebar' => $use_sidebar,
            'use_mobile_sidebar' => $use_mobile_sidebar,
            'skin_dir' => $skin_dir,
            'mobile_skin_dir' => $mobile_skin_dir,
            'page_title' => $page_title,
            'meta_description' => $meta_description,
            'meta_keywords' => $meta_keywords,
            'meta_author' => $meta_author,
            'page_name' => $page_name,
        );
        $view['layout'] = $this->managelayout->front($layoutconfig, $this->cbconfig->get_device_view_type());
        $this->data = $view;
        $this->layout = element('layout_skin_file', element('layout', $view));
        $this->view = element('view_skin_file', element('layout', $view));
    }
}
