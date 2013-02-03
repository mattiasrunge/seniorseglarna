
var mainModel = new function()
{
  var self = this;

  self.isParent = true;

  self.args = ko.observableArray();

  self.profileModel = new ProfileModel(self);
  self.newsModel = new NewsModel(self);
  self.aboutModel = new AboutModel(self);
  self.guestbookModel = new GuestbookModel(self);
  self.forumModel = new ForumModel(self);
  self.storiesModel = new StoriesModel(self);
  self.galleryModel = new GalleryModel(self);
  self.membersModel = new MembersModel(self);

  self.dummy = function()
  {
  };

}();
