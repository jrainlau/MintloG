<?php
include "conn_sql.php";
header("Content-Type:text/html;charset=utf-8");
header("Access-Control-Allow-Origin:*");
$pdo = ConnMySQL::makeConnect('localhost', 'agozou', 'admin', 'ago_blog');
$now = date('Y-m-d');
function Options($subType, $pdo, $artTag = null, $artContent = null, $now, $artTitle = null, $artId = null) {
    switch ($subType) {
        case 0:
            $result = $pdo->query('article');
            $artListAll = $result->fetchAll(PDO::FETCH_ASSOC);
            $artList = array();
            for($i = 0; $i < count($artListAll); $i++) {
                $artList[$i]['title'] = $artListAll[$i]['title'];
                $artList[$i]['tag'] = $artListAll[$i]['tag'];
                $artList[$i]['content'] = $artListAll[$i]['content'];
                $artList[$i]['time'] = $artListAll[$i]['time'];
                $artList[$i]['id'] = $artListAll[$i]['id'];
            }
            echo json_encode($artList);
            break;
        case 1:
            $result = $pdo->insert("article", "id, tag, content, time, title", "'', '$artTag', '$artContent', '$now', '$artTitle'");
            echo $result;
            break;
        case 2:
            $result = $pdo->updata("article", "tag='$artTag', content='$artContent', time='$now', title='$artTitle'", "id='$artId'");
            echo $result;
            break;
        case 3:
            $result = $pdo->delete("article", "id='$artId'");
            echo $result;
            break;
        // 通过id查找
        case 4:
            $result = $pdo->query('article','id',$artId);
            $artListAll = $result->fetchAll(PDO::FETCH_ASSOC);
            $artList = array();
            for($i = 0; $i < count($artListAll); $i++) {
                $artList[$i]['title'] = $artListAll[$i]['title'];
                $artList[$i]['tag'] = $artListAll[$i]['tag'];
                $artList[$i]['content'] = $artListAll[$i]['content'];
                $artList[$i]['time'] = $artListAll[$i]['time'];
                $artList[$i]['id'] = $artListAll[$i]['id'];
            }
            echo json_encode($artList);
            break;
        // 通过标签查找
        case 5:
            $result = $pdo->query('article','tag',$artTag);
            $artListAll = $result->fetchAll(PDO::FETCH_ASSOC);
            $artList = array();
            for($i = 0; $i < count($artListAll); $i++) {
                $artList[$i]['title'] = $artListAll[$i]['title'];
                $artList[$i]['tag'] = $artListAll[$i]['tag'];
                $artList[$i]['content'] = $artListAll[$i]['content'];
                $artList[$i]['time'] = $artListAll[$i]['time'];
                $artList[$i]['id'] = $artListAll[$i]['id'];
            }
            echo json_encode($artList);
            break;
        // 通过时间查找
        case 6:
            $result = $pdo->query('article','time',$artTag);
            $artListAll = $result->fetchAll(PDO::FETCH_ASSOC);
            $artList = array();
            for($i = 0; $i < count($artListAll); $i++) {
                $artList[$i]['title'] = $artListAll[$i]['title'];
                $artList[$i]['tag'] = $artListAll[$i]['tag'];
                $artList[$i]['content'] = $artListAll[$i]['content'];
                $artList[$i]['time'] = $artListAll[$i]['time'];
                $artList[$i]['id'] = $artListAll[$i]['id'];
            }
            echo json_encode($artList);
            break;
        // 通过题目查找
        case 7:
            $result = $pdo->query('article','title',$artTag);
            $artListAll = $result->fetchAll(PDO::FETCH_ASSOC);
            $artList = array();
            for($i = 0; $i < count($artListAll); $i++) {
                $artList[$i]['title'] = $artListAll[$i]['title'];
                $artList[$i]['tag'] = $artListAll[$i]['tag'];
                $artList[$i]['content'] = $artListAll[$i]['content'];
                $artList[$i]['time'] = $artListAll[$i]['time'];
                $artList[$i]['id'] = $artListAll[$i]['id'];
            }
            echo json_encode($artList);
            break;
        default:
            echo 'subType参数为空';
            break;
    }
}
Options($_POST[subType], $pdo, $_POST[artTag], $_POST[artContent], $now, $_POST[artTitle], $_POST[artId]);
$pdo->destruct();
?>